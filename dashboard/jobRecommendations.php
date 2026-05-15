<?php include "../includes/session.php"; ?>
<?php include "../includes/indexHeader.php"; ?>

<body>
  <?php include "../includes/indexNavbar.php"; ?>

  <div id="header"></div>

  <div class="container dashboard-container">
    <div class="dashboard-content">
      <div class="dashboard-sidebar">
        <?php include "./dashboardSidebar.php"; ?>
      </div>

      <div class="main-content">
        <h1>Recommended Jobs For You</h1>
        <p class="subtitle">Based on your profile, skills, and preferences</p>

        <?php
        if (!isset($_SESSION['id_user']) || $_SESSION['role_id'] != 1) {
          echo "<p>Only job seekers can view recommendations.</p>";
        } else {
          $id_user = $_SESSION['id_user'];

          // First, ensure user has a skills profile
          $profile_check = "SELECT * FROM user_skills_profile WHERE id_user = '$id_user'";
          $profile_result = $conn->query($profile_check);

          if ($profile_result->num_rows === 0) {
            // Create default profile
            $default_profile = "INSERT INTO user_skills_profile (id_user) VALUES ('$id_user')";
            $conn->query($default_profile);
          }

          // Get user's skills and preferences
          $user_sql = "SELECT u.skills, u.education_id, u.age, u.state_id, u.city_id,
                              usp.years_experience, usp.salary_expectation_min, usp.salary_expectation_max,
                              usp.willing_to_relocate, usp.preferred_locations, usp.work_type_preferences
                       FROM users u
                       LEFT JOIN user_skills_profile usp ON u.id_user = usp.id_user
                       WHERE u.id_user = '$id_user'";
          $user_result = $conn->query($user_sql);
          $user_data = $user_result->fetch_assoc();

          // Get all active job postings
          $jobs_sql = "SELECT jp.*, c.companyname, s.name as state_name, dc.name as city_name
                      FROM job_post jp
                      JOIN company c ON jp.id_company = c.id_company
                      LEFT JOIN states s ON jp.state_id = s.id
                      LEFT JOIN districts_or_cities dc ON jp.city_id = dc.id
                      WHERE jp.job_status = 1
                      AND jp.deadline >= CURDATE()
                      ORDER BY jp.createdat DESC
                      LIMIT 20";
          $jobs_result = $conn->query($jobs_sql);

          if ($jobs_result->num_rows > 0) {
            echo "<div class='recommendations-container'>";
            $count = 0;

            while ($job = $jobs_result->fetch_assoc()) {
              // Calculate match score
              $match_score = calculateJobMatch($user_data, $job);

              // Check if already recommended
              $check_rec = "SELECT * FROM job_recommendations WHERE id_user = '$id_user' AND id_jobpost = '{$job['id_jobpost']}'";
              $rec_result = $conn->query($check_rec);

              if ($rec_result->num_rows === 0 && $match_score >= 50) {
                // Insert recommendation
                $insert_rec = "INSERT INTO job_recommendations (id_user, id_jobpost, match_score, match_reason)
                              VALUES ('$id_user', '{$job['id_jobpost']}', '$match_score', 'AI matched based on skills and preferences')";
                $conn->query($insert_rec);
              }

              if ($match_score >= 60) {
                $count++;
                $match_percentage = min(100, round($match_score));
                $match_color = $match_percentage >= 80 ? '#28a745' : ($match_percentage >= 60 ? '#ffc107' : '#dc3545');

                echo "
                <div class='job-recommendation-card'>
                  <div class='match-score' style='background-color: $match_color;'>
                    <span class='score-value'>$match_percentage%</span>
                    <span class='score-label'>Match</span>
                  </div>
                  <div class='job-info'>
                    <h3>{$job['jobtitle']}</h3>
                    <p class='company-name'>{$job['companyname']}</p>
                    <p class='job-location'>
                      <i class='fa-solid fa-map-pin'></i>
                      {$job['city_name']}, {$job['state_name']}
                    </p>
                    <div class='salary-range'>
                      <i class='fa-solid fa-money-bill'></i>
                      TK {$job['minimumsalary']} - TK {$job['maximumsalary']}
                    </div>
                    <p class='job-description'>" . substr($job['description'], 0, 150) . "...</p>
                  </div>
                  <div class='job-actions'>
                    <a href='../jobDetails.php?key=" . md5($job['id_jobpost']) . "&id={$job['id_jobpost']}' class='btn btn-secondary'>View Details</a>
                    <a href='../process/applyJob.php?key=" . md5($job['id_jobpost']) . "&id={$job['id_jobpost']}&cid={$job['id_company']}' class='btn btn-secondary-accent'>Apply Now</a>
                  </div>
                </div>";
              }
            }

            if ($count === 0) {
              echo "<div class='no-recommendations'>
                <p>No strong job matches found yet. Complete your profile for better recommendations!</p>
                <a href='editProfile.php' class='btn btn-secondary'>Complete Profile</a>
              </div>";
            }

            echo "</div>";
          } else {
            echo "<p>No active jobs available at the moment.</p>";
          }
        }
        ?>
      </div>
    </div>
  </div>

  <style>
    .subtitle {
      color: #666;
      margin-bottom: 2rem;
      font-size: 1.1rem;
    }

    .recommendations-container {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .job-recommendation-card {
      display: grid;
      grid-template-columns: 80px 1fr auto;
      gap: 1.5rem;
      padding: 1.5rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      background: white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    .job-recommendation-card:hover {
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      transform: translateY(-2px);
    }

    .match-score {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      color: white;
      font-weight: bold;
      min-width: 80px;
    }

    .score-value {
      font-size: 1.8rem;
      font-weight: bold;
    }

    .score-label {
      font-size: 0.8rem;
      opacity: 0.9;
    }

    .job-info h3 {
      margin: 0 0 0.5rem 0;
      color: #333;
    }

    .company-name {
      color: #666;
      margin: 0.3rem 0;
      font-size: 0.95rem;
    }

    .job-location,
    .salary-range {
      color: #666;
      margin: 0.5rem 0;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .job-description {
      color: #888;
      font-size: 0.9rem;
      margin-top: 0.8rem;
      line-height: 1.4;
    }

    .job-actions {
      display: flex;
      flex-direction: column;
      gap: 0.8rem;
      justify-content: center;
    }

    .btn-secondary-accent {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 0.7rem 1.2rem;
      border-radius: 4px;
      text-align: center;
      text-decoration: none;
      transition: transform 0.2s;
      border: none;
      cursor: pointer;
      font-weight: bold;
      font-size: 0.9rem;
    }

    .btn-secondary-accent:hover {
      transform: scale(1.05);
    }

    .no-recommendations {
      text-align: center;
      padding: 3rem;
      background: #f8f9fa;
      border-radius: 8px;
      color: #666;
    }

    @media (max-width: 768px) {
      .job-recommendation-card {
        grid-template-columns: 1fr;
      }

      .match-score {
        width: 100%;
      }

      .job-actions {
        flex-direction: row;
      }
    }
  </style>

  <?php include "../includes/footer.php"; ?>
</body>
</html>

<?php
// Function to calculate job match score
function calculateJobMatch($user_data, $job) {
  $score = 0;

  // Skill match (40%)
  if ($user_data['skills'] && strpos($job['skills_ability'], $user_data['skills']) !== false) {
    $score += 40;
  } else {
    $score += 20; // partial credit
  }

  // Education match (20%)
  if ($user_data['education_id'] && $user_data['education_id'] >= (int)$job['edu_qualification']) {
    $score += 20;
  }

  // Location match (15%)
  if ($user_data['city_id'] == $job['city_id'] || $user_data['willing_to_relocate']) {
    $score += 15;
  } else {
    $score += 5;
  }

  // Salary match (15%)
  $salary_expectation = ($user_data['salary_expectation_max'] ?? $job['maximumsalary']);
  if ($salary_expectation >= $job['minimumsalary'] && $salary_expectation <= $job['maximumsalary']) {
    $score += 15;
  } else if ($salary_expectation >= $job['minimumsalary']) {
    $score += 10;
  } else {
    $score += 5;
  }

  // Experience match (10%)
  if ($user_data['years_experience'] >= $job['experience']) {
    $score += 10;
  } else if ($user_data['years_experience'] >= $job['experience'] - 2) {
    $score += 7;
  } else {
    $score += 3;
  }

  return min(100, $score);
}
?>
