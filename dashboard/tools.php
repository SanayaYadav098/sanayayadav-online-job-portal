<?php include "../includes/session.php"; ?>
<?php include "../includes/indexHeader.php"; ?>

<body>
  <?php include "../includes/indexNavbar.php"; ?>

  <div id="header"></div>

  <div class="container">
    <!-- Tools Hero Section -->
    <section class="tools-hero">
      <h1>Career Tools & Resources</h1>
      <p>Everything you need to succeed in your job search journey</p>
    </section>

    <!-- Tools Grid -->
    <section class="tools-grid">
      
      <a href="resumeBuilder.php" class="tool-card">
        <div class="tool-icon">
          <i class="fa-solid fa-file-lines"></i>
        </div>
        <h3>Resume Builder</h3>
        <p>Create a professional resume in minutes with our intuitive builder. Choose from templates and get hired faster.</p>
        <span class="tool-link">Get Started →</span>
      </a>

      <a href="interviewPrep.php" class="tool-card">
        <div class="tool-icon">
          <i class="fa-solid fa-comments"></i>
        </div>
        <h3>Interview Preparation</h3>
        <p>Prepare for your interview with comprehensive guides, common questions, and the STAR method technique.</p>
        <span class="tool-link">Learn More →</span>
      </a>

      <a href="skillAssessment.php" class="tool-card">
        <div class="tool-icon">
          <i class="fa-solid fa-chart-line"></i>
        </div>
        <h3>Skill Assessment</h3>
        <p>Test your skills in various areas and get detailed reports. Track your progress and identify improvement areas.</p>
        <span class="tool-link">Take Test →</span>
      </a>

      <a href="coverLetterGenerator.php" class="tool-card">
        <div class="tool-icon">
          <i class="fa-solid fa-envelope"></i>
        </div>
        <h3>Cover Letter Generator</h3>
        <p>Generate personalized cover letters tailored to specific jobs. Stand out from other candidates.</p>
        <span class="tool-link">Create Letter →</span>
      </a>

      <a href="jobRecommendations.php" class="tool-card">
        <div class="tool-icon">
          <i class="fa-solid fa-lightbulb"></i>
        </div>
        <h3>AI Job Recommendations</h3>
        <p>Get personalized job recommendations based on your skills, experience, and preferences using AI technology.</p>
        <span class="tool-link">View Jobs →</span>
      </a>

      <a href="myInterviews.php" class="tool-card">
        <div class="tool-icon">
          <i class="fa-solid fa-video"></i>
        </div>
        <h3>Virtual Interviews</h3>
        <p>Schedule and conduct virtual interviews with companies. Video call and chat capabilities included.</p>
        <span class="tool-link">Schedule →</span>
      </a>

    </section>

    <!-- Features Section -->
    <section class="features-section">
      <h2>Why Choose Our Platform?</h2>
      <div class="features-grid">
        <div class="feature">
          <div class="feature-icon">
            <i class="fa-solid fa-bolt"></i>
          </div>
          <h3>Lightning Fast</h3>
          <p>Create, apply, and get hired in record time with our streamlined tools.</p>
        </div>
        <div class="feature">
          <div class="feature-icon">
            <i class="fa-solid fa-lock"></i>
          </div>
          <h3>Secure & Private</h3>
          <p>Your data is encrypted and secure. We never share your information with third parties.</p>
        </div>
        <div class="feature">
          <div class="feature-icon">
            <i class="fa-solid fa-mobile"></i>
          </div>
          <h3>Mobile Friendly</h3>
          <p>Access all tools from any device, anywhere. Our platform is fully responsive.</p>
        </div>
        <div class="feature">
          <div class="feature-icon">
            <i class="fa-solid fa-graduation-cap"></i>
          </div>
          <h3>Expert Resources</h3>
          <p>Learn from industry experts and career coaches through our comprehensive guides.</p>
        </div>
        <div class="feature">
          <div class="feature-icon">
            <i class="fa-solid fa-users"></i>
          </div>
          <h3>Community Support</h3>
          <p>Connect with other job seekers and get tips, advice, and encouragement.</p>
        </div>
        <div class="feature">
          <div class="feature-icon">
            <i class="fa-solid fa-star"></i>
          </div>
          <h3>Premium Quality</h3>
          <p>Everything is designed and tested to help you succeed in your job search.</p>
        </div>
      </div>
    </section>

    <!-- Getting Started -->
    <section class="getting-started">
      <h2>Ready to Get Started?</h2>
      <div class="getting-started-steps">
        <div class="step">
          <div class="step-number">1</div>
          <h3>Complete Your Profile</h3>
          <p>Add your skills, experience, and preferences to get better recommendations.</p>
        </div>
        <div class="step">
          <div class="step-number">2</div>
          <h3>Build Your Resume</h3>
          <p>Create a professional resume using our builder or upload your existing one.</p>
        </div>
        <div class="step">
          <div class="step-number">3</div>
          <h3>Browse & Apply</h3>
          <p>Browse job listings or get AI-powered recommendations tailored for you.</p>
        </div>
        <div class="step">
          <div class="step-number">4</div>
          <h3>Prepare & Succeed</h3>
          <p>Use our interview prep tools and take skill assessments to land your dream job.</p>
        </div>
      </div>
    </section>
  </div>

  <style>
    .tools-hero {
      text-align: center;
      padding: 4rem 2rem;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 12px;
      margin: 2rem 0;
      animation: slideInDown 0.8s ease;
    }

    .tools-hero h1 {
      margin: 0;
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    .tools-hero p {
      margin: 0;
      font-size: 1.2rem;
      opacity: 0.95;
    }

    .tools-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      margin: 3rem 0;
    }

    .tool-card {
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-decoration: none;
      color: inherit;
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      border: 2px solid transparent;
      position: relative;
      overflow: hidden;
      animation: fadeInUp 0.6s ease forwards;
      animation-fill-mode: both;
    }

    .tool-card {
      animation-delay: var(--delay, 0s);
    }

    .tool-card:nth-child(1) { --delay: 0.1s; }
    .tool-card:nth-child(2) { --delay: 0.2s; }
    .tool-card:nth-child(3) { --delay: 0.3s; }
    .tool-card:nth-child(4) { --delay: 0.4s; }
    .tool-card:nth-child(5) { --delay: 0.5s; }
    .tool-card:nth-child(6) { --delay: 0.6s; }

    .tool-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 24px rgba(102, 126, 234, 0.3);
      border-color: #667eea;
    }

    .tool-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s ease;
    }

    .tool-card:hover::before {
      left: 100%;
    }

    .tool-icon {
      font-size: 3rem;
      color: #667eea;
      margin-bottom: 1rem;
      transition: transform 0.3s ease;
    }

    .tool-card:hover .tool-icon {
      transform: scale(1.1) rotate(5deg);
    }

    .tool-card h3 {
      margin: 1rem 0 0.5rem 0;
      color: #333;
      font-size: 1.3rem;
    }

    .tool-card p {
      color: #666;
      line-height: 1.6;
      margin: 0 0 1rem 0;
    }

    .tool-link {
      color: #667eea;
      font-weight: bold;
      transition: all 0.3s ease;
      display: inline-block;
    }

    .tool-card:hover .tool-link {
      transform: translateX(5px);
    }

    .features-section {
      margin: 4rem 0;
      padding: 2rem;
      background: #f8f9fa;
      border-radius: 12px;
    }

    .features-section h2 {
      text-align: center;
      margin-top: 0;
      margin-bottom: 2rem;
      font-size: 2rem;
      color: #333;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
    }

    .feature {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .feature:hover {
      transform: translateY(-5px);
    }

    .feature-icon {
      font-size: 2.5rem;
      color: #667eea;
      margin-bottom: 1rem;
    }

    .feature h3 {
      margin: 1rem 0 0.5rem 0;
      color: #333;
    }

    .feature p {
      color: #666;
      margin: 0;
      line-height: 1.6;
    }

    .getting-started {
      margin: 4rem 0;
      padding: 3rem 2rem;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 12px;
      text-align: center;
    }

    .getting-started h2 {
      margin-top: 0;
      font-size: 2rem;
      margin-bottom: 2rem;
    }

    .getting-started-steps {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
      margin-top: 2rem;
    }

    .step {
      background: rgba(255,255,255,0.1);
      padding: 2rem 1.5rem;
      border-radius: 8px;
      backdrop-filter: blur(10px);
      transition: transform 0.3s ease;
    }

    .step:hover {
      transform: translateY(-5px);
      background: rgba(255,255,255,0.15);
    }

    .step-number {
      width: 50px;
      height: 50px;
      background: rgba(255,255,255,0.3);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: bold;
      margin: 0 auto 1rem;
    }

    .step h3 {
      margin: 1rem 0 0.5rem 0;
      color: white;
    }

    .step p {
      margin: 0;
      opacity: 0.95;
      line-height: 1.6;
    }

    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 768px) {
      .tools-hero {
        padding: 2rem 1rem;
      }

      .tools-hero h1 {
        font-size: 1.8rem;
      }

      .tools-grid {
        gap: 1.5rem;
      }

      .getting-started-steps {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <?php include "../includes/footer.php"; ?>
</body>
</html>
