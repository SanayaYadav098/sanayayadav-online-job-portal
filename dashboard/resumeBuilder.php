<?php include "../includes/session.php"; ?>
<?php include "../includes/indexHeader.php"; ?>

<body>
  <?php include "../includes/indexNavbar.php"; ?>

  <div id="header"></div>

  <div class="container tools-container">
    <div class="tools-sidebar">
      <h2>Tools & Resources</h2>
      <ul class="tools-menu">
        <li><a href="tools.php" class="menu-item">Overview</a></li>
        <li><a href="resumeBuilder.php" class="menu-item active">Resume Builder</a></li>
        <li><a href="interviewPrep.php" class="menu-item">Interview Prep</a></li>
        <li><a href="skillAssessment.php" class="menu-item">Skill Assessment</a></li>
        <li><a href="coverLetterGenerator.php" class="menu-item">Cover Letter</a></li>
      </ul>
    </div>

    <div class="tools-content">
      <h1>Resume Builder</h1>
      <p class="subtitle">Create a professional resume in minutes</p>

      <div class="resume-builder-wrapper">
        <div class="builder-editor">
          <form id="resume-form" action="../process/saveResume.php" method="POST">
            
            <!-- Personal Information -->
            <section class="form-section">
              <h3><i class="fa-solid fa-user"></i> Personal Information</h3>
              <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="fullname" required placeholder="John Doe">
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Professional Headline *</label>
                  <input type="text" name="headline" required placeholder="Senior Software Engineer">
                </div>
                <div class="form-group">
                  <label>Location</label>
                  <input type="text" name="location" placeholder="Dhaka, Bangladesh">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Email *</label>
                  <input type="email" name="email" required placeholder="your@email.com">
                </div>
                <div class="form-group">
                  <label>Phone</label>
                  <input type="tel" name="phone" placeholder="+880 1234567890">
                </div>
              </div>
              <div class="form-group">
                <label>Professional Summary</label>
                <textarea name="summary" placeholder="A brief summary of your professional background and goals..." rows="4"></textarea>
              </div>
            </section>

            <!-- Experience -->
            <section class="form-section">
              <h3><i class="fa-solid fa-briefcase"></i> Experience</h3>
              <div id="experiences-container"></div>
              <button type="button" class="btn btn-add-more" onclick="addExperience()">+ Add Experience</button>
            </section>

            <!-- Education -->
            <section class="form-section">
              <h3><i class="fa-solid fa-graduation-cap"></i> Education</h3>
              <div id="education-container"></div>
              <button type="button" class="btn btn-add-more" onclick="addEducation()">+ Add Education</button>
            </section>

            <!-- Skills -->
            <section class="form-section">
              <h3><i class="fa-solid fa-star"></i> Skills</h3>
              <div id="skills-container"></div>
              <button type="button" class="btn btn-add-more" onclick="addSkill()">+ Add Skill</button>
            </section>

            <!-- Certifications -->
            <section class="form-section">
              <h3><i class="fa-solid fa-certificate"></i> Certifications</h3>
              <div id="certifications-container"></div>
              <button type="button" class="btn btn-add-more" onclick="addCertification()">+ Add Certification</button>
            </section>

            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Save Resume</button>
              <button type="button" class="btn btn-secondary" onclick="previewResume()">Preview</button>
            </div>
          </form>
        </div>

        <div class="resume-preview">
          <h3>Preview</h3>
          <div id="preview-content" class="preview-document">
            <p>Your resume preview will appear here</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .tools-container {
      display: grid;
      grid-template-columns: 250px 1fr;
      gap: 2rem;
      padding: 2rem 0;
      min-height: 80vh;
    }

    .tools-sidebar {
      background: #f8f9fa;
      padding: 2rem;
      border-radius: 8px;
      height: fit-content;
      position: sticky;
      top: 100px;
    }

    .tools-sidebar h2 {
      margin-top: 0;
      color: #333;
      border-bottom: 2px solid #007bff;
      padding-bottom: 1rem;
    }

    .tools-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .tools-menu .menu-item {
      display: block;
      padding: 0.8rem 1rem;
      margin: 0.5rem 0;
      color: #666;
      text-decoration: none;
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .tools-menu .menu-item:hover,
    .tools-menu .menu-item.active {
      background: #007bff;
      color: white;
    }

    .subtitle {
      color: #666;
      margin-bottom: 2rem;
    }

    .resume-builder-wrapper {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
    }

    .builder-editor {
      background: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 2rem;
    }

    .form-section {
      margin-bottom: 2rem;
      padding-bottom: 2rem;
      border-bottom: 2px solid #eee;
    }

    .form-section h3 {
      color: #333;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.8rem;
    }

    .form-section h3 i {
      color: #007bff;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      color: #333;
      font-weight: 500;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-family: Arial, sans-serif;
    }

    .form-group textarea {
      resize: vertical;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .btn-add-more {
      background: #f0f0f0;
      color: #333;
      padding: 0.6rem 1rem;
      border: 1px dashed #007bff;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-add-more:hover {
      background: #e7f3ff;
      border-color: #007bff;
    }

    .form-actions {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
      justify-content: center;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 1rem 2rem;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: transform 0.2s;
    }

    .btn-primary:hover {
      transform: scale(1.05);
    }

    .resume-preview {
      background: #f8f9fa;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 2rem;
      height: fit-content;
      position: sticky;
      top: 100px;
    }

    .resume-preview h3 {
      margin-top: 0;
      color: #333;
    }

    .preview-document {
      background: white;
      padding: 1.5rem;
      border-radius: 4px;
      max-height: 600px;
      overflow-y: auto;
      font-size: 0.9rem;
      line-height: 1.6;
    }

    .form-entry {
      background: #f8f9fa;
      padding: 1rem;
      border-radius: 4px;
      margin-bottom: 1rem;
      position: relative;
    }

    .form-entry .btn-remove {
      position: absolute;
      top: 0.5rem;
      right: 0.5rem;
      background: #dc3545;
      color: white;
      border: none;
      padding: 0.3rem 0.6rem;
      border-radius: 3px;
      cursor: pointer;
      font-size: 0.8rem;
    }

    @media (max-width: 1024px) {
      .resume-builder-wrapper {
        grid-template-columns: 1fr;
      }

      .tools-container {
        grid-template-columns: 1fr;
      }

      .tools-sidebar {
        position: static;
      }

      .resume-preview {
        position: static;
      }
    }
  </style>

  <script>
    let experienceCount = 0;
    let educationCount = 0;
    let skillCount = 0;
    let certificationCount = 0;

    function addExperience() {
      const container = document.getElementById('experiences-container');
      const id = experienceCount++;
      const entry = document.createElement('div');
      entry.className = 'form-entry';
      entry.id = `experience-${id}`;
      entry.innerHTML = `
        <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Remove</button>
        <div class="form-row">
          <div class="form-group">
            <label>Job Title</label>
            <input type="text" name="exp_title_${id}" placeholder="Senior Developer">
          </div>
          <div class="form-group">
            <label>Company</label>
            <input type="text" name="exp_company_${id}" placeholder="ABC Corporation">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="exp_start_${id}">
          </div>
          <div class="form-group">
            <label>End Date</label>
            <input type="date" name="exp_end_${id}">
          </div>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="exp_desc_${id}" placeholder="Describe your responsibilities..." rows="3"></textarea>
        </div>
      `;
      container.appendChild(entry);
    }

    function addEducation() {
      const container = document.getElementById('education-container');
      const id = educationCount++;
      const entry = document.createElement('div');
      entry.className = 'form-entry';
      entry.id = `education-${id}`;
      entry.innerHTML = `
        <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Remove</button>
        <div class="form-row">
          <div class="form-group">
            <label>Degree</label>
            <input type="text" name="edu_degree_${id}" placeholder="Bachelor's in Computer Science">
          </div>
          <div class="form-group">
            <label>Institution</label>
            <input type="text" name="edu_school_${id}" placeholder="University Name">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Graduation Year</label>
            <input type="number" name="edu_year_${id}" placeholder="2023">
          </div>
          <div class="form-group">
            <label>GPA</label>
            <input type="text" name="edu_gpa_${id}" placeholder="3.8">
          </div>
        </div>
      `;
      container.appendChild(entry);
    }

    function addSkill() {
      const container = document.getElementById('skills-container');
      const id = skillCount++;
      const entry = document.createElement('div');
      entry.className = 'form-entry';
      entry.id = `skill-${id}`;
      entry.innerHTML = `
        <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Remove</button>
        <div class="form-row">
          <div class="form-group">
            <label>Skill</label>
            <input type="text" name="skill_name_${id}" placeholder="JavaScript">
          </div>
          <div class="form-group">
            <label>Proficiency Level</label>
            <select name="skill_level_${id}">
              <option>Select Level</option>
              <option>Beginner</option>
              <option>Intermediate</option>
              <option>Advanced</option>
              <option>Expert</option>
            </select>
          </div>
        </div>
      `;
      container.appendChild(entry);
    }

    function addCertification() {
      const container = document.getElementById('certifications-container');
      const id = certificationCount++;
      const entry = document.createElement('div');
      entry.className = 'form-entry';
      entry.id = `cert-${id}`;
      entry.innerHTML = `
        <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Remove</button>
        <div class="form-row">
          <div class="form-group">
            <label>Certification Name</label>
            <input type="text" name="cert_name_${id}" placeholder="AWS Certified Developer">
          </div>
          <div class="form-group">
            <label>Issuing Organization</label>
            <input type="text" name="cert_org_${id}" placeholder="Amazon Web Services">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Date Obtained</label>
            <input type="date" name="cert_date_${id}">
          </div>
          <div class="form-group">
            <label>Credential ID</label>
            <input type="text" name="cert_id_${id}" placeholder="(Optional)">
          </div>
        </div>
      `;
      container.appendChild(entry);
    }

    function previewResume() {
      const form = document.getElementById('resume-form');
      const formData = new FormData(form);
      const previewContent = document.getElementById('preview-content');

      let html = '<div class="resume-header">';
      html += '<h2>' + (formData.get('fullname') || 'Your Name') + '</h2>';
      html += '<p class="headline">' + (formData.get('headline') || 'Professional Headline') + '</p>';
      html += '</div>';

      if (formData.get('summary')) {
        html += '<div class="resume-section"><h4>Summary</h4><p>' + formData.get('summary') + '</p></div>';
      }

      previewContent.innerHTML = html;
    }

    // Preview updates in real-time
    document.getElementById('fullname')?.addEventListener('change', previewResume);
    document.getElementById('headline')?.addEventListener('change', previewResume);
  </script>

  <?php include "../includes/footer.php"; ?>
</body>
</html>
