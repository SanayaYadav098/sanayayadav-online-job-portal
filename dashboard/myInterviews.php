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
        <h1>My Interviews</h1>

        <?php
        // Check if user is logged in and is a job seeker (role_id = 1)
        if (!isset($_SESSION['id_user']) || $_SESSION['role_id'] != 1) {
          echo "<p>Only job seekers can access this page.</p>";
        } else {
          $id_user = $_SESSION['id_user'];

          // Get all interviews for this job seeker
          $sql = "SELECT i.*, j.jobtitle, c.companyname, a.id_applied
                  FROM interview_schedules i
                  JOIN applied_jobposts a ON i.id_application = a.id_applied
                  JOIN job_post j ON i.id_jobpost = j.id_jobpost
                  JOIN company c ON i.id_company = c.id_company
                  WHERE i.id_jobseeker = '$id_user'
                  ORDER BY i.interview_date DESC";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            echo "<div class='interviews-container'>";
            while ($row = $result->fetch_assoc()) {
              $interview_id = $row['id_interview'];
              $status = $row['status'];
              $interview_date = date("M d, Y - h:i A", strtotime($row['interview_date']));
              $interview_type = ucfirst(str_replace('_', ' ', $row['interview_type']));

              $status_class = match($status) {
                'scheduled' => 'status-scheduled',
                'ongoing' => 'status-ongoing',
                'completed' => 'status-completed',
                'cancelled' => 'status-cancelled',
                default => 'status-scheduled'
              };

              echo "
              <div class='interview-card'>
                <div class='interview-header'>
                  <h3>{$row['jobtitle']}</h3>
                  <span class='interview-status {$status_class}'>".ucfirst($status)."</span>
                </div>
                <div class='interview-body'>
                  <p><strong>Company:</strong> {$row['companyname']}</p>
                  <p><strong>Date & Time:</strong> {$interview_date}</p>
                  <p><strong>Type:</strong> {$interview_type}</p>";

              if ($row['notes']) {
                echo "<p><strong>Notes:</strong> {$row['notes']}</p>";
              }

              echo "
                </div>
                <div class='interview-footer'>";

              if ($status === 'scheduled' && strtotime($row['interview_date']) > time()) {
                echo "<a href='joinInterview.php?id={$interview_id}' class='btn btn-secondary'>Join Interview</a>";
              } elseif ($status === 'completed') {
                echo "<a href='viewInterviewFeedback.php?id={$interview_id}' class='btn btn-secondary'>View Feedback</a>";
              }

              echo "
                </div>
              </div>";
            }
            echo "</div>";
          } else {
            echo "<div class='no-data-message'>
              <p>You have no scheduled interviews yet.</p>
              <p>Browse jobs and apply to get started!</p>
              <a href='../findJobs.php' class='btn btn-secondary'>Browse Jobs</a>
            </div>";
          }
        }
        ?>
      </div>
    </div>
  </div>

  <style>
    .dashboard-container {
      display: flex;
      gap: 2rem;
      padding: 2rem 0;
    }

    .interviews-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
      gap: 2rem;
    }

    .interview-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .interview-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .interview-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .interview-header h3 {
      margin: 0;
      font-size: 1.2rem;
    }

    .interview-status {
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: bold;
    }

    .status-scheduled {
      background: #ffc107;
      color: #000;
    }

    .status-ongoing {
      background: #17a2b8;
      color: white;
    }

    .status-completed {
      background: #28a745;
      color: white;
    }

    .status-cancelled {
      background: #dc3545;
      color: white;
    }

    .interview-body {
      padding: 1.5rem;
    }

    .interview-body p {
      margin: 0.8rem 0;
      color: #333;
    }

    .interview-footer {
      padding: 1rem 1.5rem;
      border-top: 1px solid #eee;
      display: flex;
      gap: 1rem;
    }

    .no-data-message {
      text-align: center;
      padding: 3rem;
      background: #f8f9fa;
      border-radius: 8px;
      color: #666;
    }

    .no-data-message p {
      margin: 1rem 0;
    }
  </style>

  <?php include "../includes/footer.php"; ?>
</body>
</html>
