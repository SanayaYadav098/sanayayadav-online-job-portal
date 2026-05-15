# Installation & Setup Checklist

## Pre-Installation
- [ ] Backup your database
- [ ] Backup all project files
- [ ] Test in development environment first

## Step 1: Database Setup
- [ ] Open phpMyAdmin or MySQL console
- [ ] Import `database_upgrade.sql` file
- [ ] Verify all 12 new tables created:
  - [ ] interview_schedules
  - [ ] interview_messages
  - [ ] interview_feedback
  - [ ] user_skills_profile
  - [ ] job_recommendations
  - [ ] resume_drafts
  - [ ] interview_resources
  - [ ] skill_assessments
  - [ ] assessment_questions
  - [ ] user_assessment_results
  - [ ] user_theme_preferences
  - [ ] cover_letters

## Step 2: File Placement
- [ ] Copy all new PHP files to `dashboard/`:
  - [ ] myInterviews.php
  - [ ] joinInterview.php
  - [ ] jobRecommendations.php
  - [ ] resumeBuilder.php
  - [ ] interviewPrep.php
  - [ ] tools.php
  - [ ] skillAssessment.php (placeholder)
  - [ ] coverLetterGenerator.php (placeholder)

- [ ] Copy process files to `process/`:
  - [ ] sendInterviewMessage.php
  - [ ] saveThemePreference.php

- [ ] Copy CSS files to `assets/css/`:
  - [ ] darkmode.css
  - [ ] animations.css

- [ ] Copy JS files to `assets/js/`:
  - [ ] darkmode.js

## Step 3: Header Update
- [ ] Update `includes/indexHeader.php` to include:
  - [ ] darkmode.css link
  - [ ] darkmode.js script tag
  - [ ] animations.css link
  - [ ] Verify Font Awesome is included

## Step 4: Sidebar Navigation Update
- [ ] Update `dashboard/dashboardSidebar.php` to add new menu items:
  - [ ] Job Recommendations link
  - [ ] My Interviews link
  - [ ] Tools link
  - [ ] Resume Builder link

## Step 5: Feature Testing

### Dark Mode
- [ ] Click toggle button (bottom-right corner)
- [ ] Verify colors change correctly
- [ ] Test keyboard shortcut (Alt+D)
- [ ] Refresh page and verify preference persists
- [ ] Test on different pages

### Interviews
- [ ] Login as job seeker
- [ ] Go to Dashboard → My Interviews
- [ ] Verify interview list loads (if any scheduled)
- [ ] Test interview scheduling (manual database insert for testing)
- [ ] Click "Join Interview" button
- [ ] Test chat message sending
- [ ] Verify message history loads

### Job Recommendations
- [ ] Login as job seeker
- [ ] Go to Dashboard → Job Recommendations
- [ ] Verify jobs are recommended
- [ ] Check match scores are calculated
- [ ] Test "View Details" button
- [ ] Test "Apply Now" button

### Resume Builder
- [ ] Go to Tools → Resume Builder
- [ ] Fill in sample data
- [ ] Add experience, education, skills
- [ ] Test "Preview" button
- [ ] Verify preview updates in real-time
- [ ] Click "Save Resume"
- [ ] Verify resume saved (check database)

### Interview Prep
- [ ] Go to Tools → Interview Prep
- [ ] Read through sections
- [ ] Test FAQ expandable items
- [ ] Verify all tips load correctly
- [ ] Check STAR method section
- [ ] Review checklist items

### Tools Overview
- [ ] Go to Dashboard → Tools
- [ ] Verify all tool cards display
- [ ] Test hover animations
- [ ] Verify links work to each tool
- [ ] Check responsive design on mobile

## Step 6: Responsive Design Testing
- [ ] Test on mobile (320px width)
  - [ ] Single column layouts
  - [ ] Buttons are clickable
  - [ ] No horizontal scroll
  
- [ ] Test on tablet (768px width)
  - [ ] 2-column layouts
  - [ ] Proper spacing
  
- [ ] Test on desktop (1440px width)
  - [ ] Multi-column grids
  - [ ] Proper alignment

## Step 7: Cross-Browser Testing
- [ ] Chrome/Chromium
  - [ ] Dark mode
  - [ ] Animations smooth
  - [ ] Forms work
  
- [ ] Firefox
  - [ ] CSS variables work
  - [ ] Animations smooth
  - [ ] Dark mode colors correct
  
- [ ] Safari
  - [ ] Gradient backgrounds render
  - [ ] Animations work
  - [ ] Font Awesome icons display
  
- [ ] Edge
  - [ ] No console errors
  - [ ] Layout correct
  - [ ] All features functional

## Step 8: Accessibility Testing
- [ ] Keyboard navigation (Tab through page)
- [ ] Dark mode focus states visible
- [ ] Screen reader testing (if available)
- [ ] Color contrast (use Web AIM checker)
- [ ] Form labels properly associated

## Step 9: Performance Testing
- [ ] Page load time < 3 seconds
- [ ] No JavaScript errors in console
- [ ] Animations smooth (60 FPS)
- [ ] Dark mode toggle instant
- [ ] Forms submit without lag

## Step 10: Security Review
- [ ] Check for SQL injection risks
- [ ] Verify session handling
- [ ] Test authentication on protected pages
- [ ] Check file upload restrictions
- [ ] Review error messages (no system info exposed)

## Step 11: Documentation
- [ ] Read IMPLEMENTATION_GUIDE.md
- [ ] Update your project README
- [ ] Document any customizations made
- [ ] Keep database backup
- [ ] Save upgrade script for future reference

## Step 12: Deployment (When Ready)
- [ ] All tests passed ✓
- [ ] Database backed up ✓
- [ ] Files backed up ✓
- [ ] Update production database
- [ ] Upload files to production
- [ ] Test all features on production
- [ ] Monitor for errors in logs

## Post-Deployment
- [ ] Monitor error logs for issues
- [ ] Gather user feedback
- [ ] Fix any bugs found
- [ ] Plan next features
- [ ] Schedule regular backups

---

## Troubleshooting Guide

### Issue: "Table doesn't exist" error
**Solution**: 
1. Run database_upgrade.sql again
2. Check database name is correct
3. Verify all SQL executed without errors

### Issue: Dark mode CSS not applying
**Solution**:
1. Clear browser cache (Ctrl+Shift+Del)
2. Check darkmode.css path in header
3. Verify CSS file uploaded correctly
4. Check for CSS conflicts in styles.css

### Issue: JavaScript errors in console
**Solution**:
1. Check darkmode.js path
2. Verify jQuery/dependencies loaded
3. Check for syntax errors
4. Use browser DevTools to debug

### Issue: Database connection error
**Solution**:
1. Check conn.php credentials
2. Verify database exists
3. Check user permissions
4. Restart MySQL server

### Issue: Forms not submitting
**Solution**:
1. Check form action path
2. Verify POST parameters
3. Check server error logs
4. Test with simple form first

### Issue: Animations not working
**Solution**:
1. Verify animations.css loaded
2. Check browser supports CSS animations
3. Disable "Reduce motion" in OS settings
4. Check for CSS conflicts

---

## Performance Optimization Tips

- [ ] Minify CSS and JavaScript
- [ ] Optimize image sizes
- [ ] Enable GZIP compression
- [ ] Use CDN for assets
- [ ] Implement caching headers
- [ ] Lazy load images
- [ ] Reduce database queries
- [ ] Implement pagination for large lists

---

## Security Hardening (Recommended)

- [ ] Migrate to PDO for database queries
- [ ] Add CSRF token validation
- [ ] Implement rate limiting
- [ ] Add password hashing (bcrypt/Argon2)
- [ ] Use HTTPS/SSL
- [ ] Implement Two-Factor Authentication
- [ ] Add input sanitization
- [ ] Use prepared statements
- [ ] Implement logging system
- [ ] Regular security audits

---

## Next Steps After Installation

1. **Populate Sample Data**
   - Add interview schedule samples for testing
   - Add interview resources and tips
   - Create sample resumes

2. **User Training**
   - Create user guide for new features
   - Record video tutorials
   - Set up FAQ section

3. **Monitor Performance**
   - Check error logs daily
   - Monitor page load times
   - Track user engagement

4. **Plan Phase 2 Features**
   - Real WebRTC video interviews
   - PDF resume export
   - Email notifications
   - Mobile app

---

## Quick Command Reference

```bash
# Backup database
mysqldump -u root -p jobportal > backup.sql

# Restore database
mysql -u root -p jobportal < backup.sql

# Import new tables
mysql -u root -p jobportal < database_upgrade.sql

# Check MySQL status
systemctl status mysql

# Clear browser cache (per browser settings)
```

---

**Estimated Setup Time: 2-3 hours**

**Questions?** Check IMPLEMENTATION_GUIDE.md or review the code comments.

Good luck with your enhanced Job Portal! 🚀
