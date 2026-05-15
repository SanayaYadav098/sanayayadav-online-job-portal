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
        <li><a href="resumeBuilder.php" class="menu-item">Resume Builder</a></li>
        <li><a href="interviewPrep.php" class="menu-item active">Interview Prep</a></li>
        <li><a href="skillAssessment.php" class="menu-item">Skill Assessment</a></li>
        <li><a href="coverLetterGenerator.php" class="menu-item">Cover Letter</a></li>
      </ul>
    </div>

    <div class="tools-content">
      <h1>Interview Preparation Guide</h1>
      <p class="subtitle">Ace your next interview with our comprehensive preparation resources</p>

      <div class="prep-sections">
        
        <!-- Before the Interview -->
        <section class="prep-section">
          <h2><i class="fa-solid fa-clipboard"></i> Before the Interview</h2>
          <div class="prep-cards">
            <div class="prep-card">
              <h3>Research the Company</h3>
              <ul>
                <li>Study the company's mission, values, and culture</li>
                <li>Review their recent news and achievements</li>
                <li>Understand their products/services</li>
                <li>Check their social media and career pages</li>
              </ul>
            </div>
            <div class="prep-card">
              <h3>Prepare Your Story</h3>
              <ul>
                <li>Practice your elevator pitch (30 seconds)</li>
                <li>Prepare examples from your experience</li>
                <li>Identify 3-5 key strengths to highlight</li>
                <li>Plan how to address any gaps in experience</li>
              </ul>
            </div>
            <div class="prep-card">
              <h3>Logistics</h3>
              <ul>
                <li>Test your video/audio setup (if virtual)</li>
                <li>Plan your route and leave early</li>
                <li>Dress appropriately for the industry</li>
                <li>Prepare multiple copies of your resume</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- Common Interview Questions -->
        <section class="prep-section">
          <h2><i class="fa-solid fa-comments"></i> Common Interview Questions</h2>
          <div class="faq-container">
            <?php
            $questions = [
              [
                'q' => 'Tell me about yourself',
                'tips' => [
                  'Start with your most recent role or education',
                  'Highlight relevant skills and achievements',
                  'Connect your experience to the job',
                  'Keep it to 2-3 minutes',
                  'Use the STAR method for examples'
                ]
              ],
              [
                'q' => 'Why are you interested in this position?',
                'tips' => [
                  'Research the role thoroughly before answering',
                  'Explain how your skills match their needs',
                  'Show genuine interest in the company',
                  'Mention specific aspects of the role that appeal to you',
                  'Avoid salary-focused answers'
                ]
              ],
              [
                'q' => 'What are your strengths?',
                'tips' => [
                  'Choose strengths relevant to the job',
                  'Provide specific examples',
                  'Focus on 3-4 key strengths',
                  'Back up claims with accomplishments',
                  'Be authentic and confident'
                ]
              ],
              [
                'q' => 'What are your weaknesses?',
                'tips' => [
                  'Choose a real weakness, not a fake strength in disguise',
                  'Explain what you\'re doing to improve',
                  'Pick something not critical for the job',
                  'Show self-awareness and growth mindset',
                  'Keep it brief and move forward'
                ]
              ],
              [
                'q' => 'Where do you see yourself in 5 years?',
                'tips' => [
                  'Show ambition and growth plans',
                  'Align your goals with the company',
                  'Be specific but flexible',
                  'Mention skill development plans',
                  'Avoid saying you\'ll leave the company'
                ]
              ]
            ];

            foreach ($questions as $index => $item) {
              echo "
              <div class='faq-item'>
                <button class='faq-question' onclick='toggleFaq(this)'>
                  <span>{$item['q']}</span>
                  <i class='fa-solid fa-chevron-down'></i>
                </button>
                <div class='faq-answer' style='display: none;'>
                  <h4>Tips for answering:</h4>
                  <ul>";
                  foreach ($item['tips'] as $tip) {
                    echo "<li>$tip</li>";
                  }
                  echo "</ul>
                </div>
              </div>";
            }
            ?>
          </div>
        </section>

        <!-- The STAR Method -->
        <section class="prep-section">
          <h2><i class="fa-solid fa-star"></i> The STAR Method</h2>
          <div class="star-method">
            <div class="star-box">
              <h3>S - Situation</h3>
              <p>Describe the specific context or challenge you faced. Provide enough detail for understanding but keep it concise.</p>
              <example>Example: "When I was working as a junior developer..."</example>
            </div>
            <div class="star-box">
              <h3>T - Task</h3>
              <p>Explain your responsibility or what was expected of you in that situation.</p>
              <example>Example: "I was assigned to fix critical bugs in the legacy system..."</example>
            </div>
            <div class="star-box">
              <h3>A - Action</h3>
              <p>Describe the specific actions you took to address the challenge. Focus on "I" not "we".</p>
              <example>Example: "I analyzed the code, created a test plan, and systematically fixed each bug..."</example>
            </div>
            <div class="star-box">
              <h3>R - Result</h3>
              <p>Share the outcome of your actions. Use numbers and specific achievements when possible.</p>
              <example>Example: "Within 2 weeks, I resolved 15 critical bugs, reducing error rate by 40%..."</example>
            </div>
          </div>
        </section>

        <!-- Technical Interview Tips -->
        <section class="prep-section">
          <h2><i class="fa-solid fa-code"></i> Technical Interview Tips</h2>
          <div class="prep-cards">
            <div class="prep-card">
              <h3>Before Coding</h3>
              <ul>
                <li>Understand the problem completely</li>
                <li>Ask clarifying questions</li>
                <li>Discuss your approach first</li>
                <li>Consider edge cases</li>
              </ul>
            </div>
            <div class="prep-card">
              <h3>While Coding</h3>
              <ul>
                <li>Think out loud to show your process</li>
                <li>Write clean, readable code</li>
                <li>Add comments explaining logic</li>
                <li>Test with examples as you go</li>
              </ul>
            </div>
            <div class="prep-card">
              <h3>After Coding</h3>
              <ul>
                <li>Review your solution</li>
                <li>Test with edge cases</li>
                <li>Discuss time and space complexity</li>
                <li>Suggest potential optimizations</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- Interview Day Checklist -->
        <section class="prep-section">
          <h2><i class="fa-solid fa-list-check"></i> Interview Day Checklist</h2>
          <div class="checklist">
            <label><input type="checkbox"> Get a good night's sleep</label>
            <label><input type="checkbox"> Eat a healthy breakfast</label>
            <label><input type="checkbox"> Dress professionally</label>
            <label><input type="checkbox"> Leave home 15 minutes early</label>
            <label><input type="checkbox"> Bring extra resumes and a notepad</label>
            <label><input type="checkbox"> Have your phone on silent</label>
            <label><input type="checkbox"> Take deep breaths to calm nerves</label>
            <label><input type="checkbox"> Greet interviewer with firm handshake</label>
            <label><input type="checkbox"> Make eye contact and smile</label>
            <label><input type="checkbox"> Listen carefully and answer thoughtfully</label>
            <label><input type="checkbox"> Ask thoughtful questions about the role</label>
            <label><input type="checkbox"> Send thank you email within 24 hours</label>
          </div>
        </section>

        <!-- Questions to Ask -->
        <section class="prep-section">
          <h2><i class="fa-solid fa-question"></i> Questions You Should Ask</h2>
          <div class="questions-list">
            <h3>About the Role</h3>
            <ul>
              <li>What does success look like in this position?</li>
              <li>What are the key challenges in this role?</li>
              <li>What's the team structure and who would I be working with?</li>
              <li>What are the growth opportunities in this position?</li>
            </ul>

            <h3>About the Company</h3>
            <ul>
              <li>How does this company approach employee development?</li>
              <li>What's the company culture like?</li>
              <li>What metrics does the company measure success by?</li>
              <li>What's your favorite aspect of working here?</li>
            </ul>

            <h3>About the Interview Process</h3>
            <ul>
              <li>What's the timeline for making a decision?</li>
              <li>What's the next step in the interview process?</li>
              <li>Is there anything else I can clarify for you?</li>
              <li>How can I best stay in touch?</li>
            </ul>
          </div>
        </section>

      </div>

      <div class="prep-footer">
        <p>Remember: Confidence comes from preparation. Practice your answers, research thoroughly, and believe in yourself!</p>
        <a href="skillAssessment.php" class="btn btn-secondary">Take Skill Assessment</a>
      </div>
    </div>
  </div>

  <style>
    .prep-sections {
      margin-bottom: 3rem;
    }

    .prep-section {
      margin-bottom: 3rem;
    }

    .prep-section h2 {
      color: #333;
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.8rem;
    }

    .prep-section h2 i {
      color: #667eea;
    }

    .prep-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    .prep-card {
      background: #f8f9fa;
      padding: 1.5rem;
      border-radius: 8px;
      border-left: 4px solid #667eea;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .prep-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .prep-card h3 {
      margin-top: 0;
      color: #333;
      margin-bottom: 1rem;
    }

    .prep-card ul {
      margin: 0;
      padding-left: 1.5rem;
    }

    .prep-card li {
      margin-bottom: 0.5rem;
      color: #666;
    }

    .faq-container {
      background: #f8f9fa;
      border-radius: 8px;
      padding: 1.5rem;
    }

    .faq-item {
      margin-bottom: 1rem;
      border-bottom: 1px solid #ddd;
    }

    .faq-item:last-child {
      border-bottom: none;
    }

    .faq-question {
      width: 100%;
      padding: 1rem;
      background: white;
      border: 1px solid #ddd;
      border-radius: 4px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 1rem;
      color: #333;
      margin-bottom: 0.5rem;
      transition: all 0.3s ease;
    }

    .faq-question:hover {
      background: #f0f0f0;
      border-color: #667eea;
    }

    .faq-question i {
      transition: transform 0.3s ease;
    }

    .faq-question.active i {
      transform: rotate(180deg);
    }

    .faq-answer {
      padding: 1.5rem;
      background: white;
      border: 1px solid #ddd;
      border-top: none;
      border-radius: 0 0 4px 4px;
      margin-bottom: 1rem;
    }

    .faq-answer h4 {
      margin-top: 0;
      color: #667eea;
    }

    .faq-answer ul {
      margin: 0;
      padding-left: 1.5rem;
    }

    .faq-answer li {
      margin-bottom: 0.5rem;
      color: #666;
    }

    .star-method {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .star-box {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 2rem;
      border-radius: 8px;
      text-align: center;
    }

    .star-box h3 {
      margin-top: 0;
      font-size: 1.3rem;
      margin-bottom: 1rem;
    }

    .star-box example {
      display: block;
      background: rgba(255,255,255,0.2);
      padding: 0.8rem;
      border-radius: 4px;
      margin-top: 1rem;
      font-size: 0.9rem;
      font-style: italic;
    }

    .checklist {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      background: #f8f9fa;
      padding: 2rem;
      border-radius: 8px;
    }

    .checklist label {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      cursor: pointer;
      padding: 0.5rem;
    }

    .checklist input[type="checkbox"] {
      width: 20px;
      height: 20px;
      cursor: pointer;
      accent-color: #667eea;
    }

    .questions-list {
      background: #f8f9fa;
      padding: 2rem;
      border-radius: 8px;
    }

    .questions-list h3 {
      color: #667eea;
      margin-top: 0;
      margin-bottom: 1rem;
    }

    .questions-list ul {
      margin-bottom: 2rem;
      padding-left: 1.5rem;
    }

    .questions-list li {
      margin-bottom: 0.8rem;
      color: #666;
    }

    .prep-footer {
      text-align: center;
      padding: 2rem;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 8px;
      margin-top: 2rem;
    }

    .prep-footer p {
      margin-top: 0;
      margin-bottom: 1.5rem;
      font-size: 1.1rem;
    }

    @media (max-width: 768px) {
      .prep-cards {
        grid-template-columns: 1fr;
      }

      .star-method {
        grid-template-columns: 1fr;
      }

      .checklist {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <script>
    function toggleFaq(button) {
      const answer = button.nextElementSibling;
      button.classList.toggle('active');
      
      if (answer.style.display === 'none') {
        answer.style.display = 'block';
      } else {
        answer.style.display = 'none';
      }
    }
  </script>

  <?php include "../includes/footer.php"; ?>
</body>
</html>
