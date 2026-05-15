// =============================================
// DARK MODE FUNCTIONALITY
// =============================================

(function() {
  'use strict';

  // Initialize dark mode on page load
  function initDarkMode() {
    // Check if user has dark mode preference saved
    const savedDarkMode = localStorage.getItem('darkMode');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    // Use saved preference or system preference
    const shouldBeDark = savedDarkMode !== null ? JSON.parse(savedDarkMode) : prefersDark;

    if (shouldBeDark) {
      enableDarkMode();
    } else {
      disableDarkMode();
    }

    // Create toggle button if it doesn't exist
    createDarkModeToggle();
  }

  // Enable dark mode
  function enableDarkMode() {
    document.body.classList.add('dark-mode');
    localStorage.setItem('darkMode', JSON.stringify(true));
    updateToggleButton(true);
  }

  // Disable dark mode
  function disableDarkMode() {
    document.body.classList.remove('dark-mode');
    localStorage.setItem('darkMode', JSON.stringify(false));
    updateToggleButton(false);
  }

  // Toggle dark mode
  function toggleDarkMode() {
    if (document.body.classList.contains('dark-mode')) {
      disableDarkMode();
    } else {
      enableDarkMode();
    }
  }

  // Create and inject dark mode toggle button
  function createDarkModeToggle() {
    // Check if button already exists
    if (document.getElementById('dark-mode-toggle')) {
      return;
    }

    const button = document.createElement('button');
    button.id = 'dark-mode-toggle';
    button.className = 'dark-mode-toggle';
    button.title = 'Toggle Dark Mode';
    button.setAttribute('aria-label', 'Toggle Dark Mode');
    button.innerHTML = '<i class="fa-solid fa-moon"></i>';

    button.addEventListener('click', toggleDarkMode);

    // Add to body
    document.body.appendChild(button);

    // Update icon
    updateToggleButton(document.body.classList.contains('dark-mode'));
  }

  // Update toggle button icon
  function updateToggleButton(isDarkMode) {
    const button = document.getElementById('dark-mode-toggle');
    if (button) {
      button.innerHTML = isDarkMode 
        ? '<i class="fa-solid fa-sun"></i>' 
        : '<i class="fa-solid fa-moon"></i>';
    }
  }

  // Save theme preference to database (optional)
  function saveThemePreference(isDarkMode) {
    // Only if user is logged in
    const emailElement = document.querySelector('[data-user-email]');
    if (emailElement) {
      fetch('../process/saveThemePreference.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          dark_mode: isDarkMode
        })
      }).catch(err => console.log('Theme preference saved locally only'));
    }
  }

  // Listen for system theme changes
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    // Only apply if user hasn't set a manual preference
    if (localStorage.getItem('darkMode') === null) {
      if (e.matches) {
        enableDarkMode();
      } else {
        disableDarkMode();
      }
    }
  });

  // Smooth color transitions on mode change
  function setSmoothTransitions(enable) {
    const root = document.documentElement;
    if (enable) {
      root.style.setProperty('transition-duration', '0.3s');
    } else {
      root.style.setProperty('transition-duration', '0s');
    }
  }

  // Initialize on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDarkMode);
  } else {
    initDarkMode();
  }

  // Expose functions globally for manual control
  window.darkMode = {
    enable: enableDarkMode,
    disable: disableDarkMode,
    toggle: toggleDarkMode,
    isEnabled: () => document.body.classList.contains('dark-mode')
  };

})();

// =============================================
// THEME COLOR UTILITIES
// =============================================

/**
 * Get current theme colors as object
 */
function getThemeColors() {
  const root = document.documentElement;
  const style = getComputedStyle(root);

  return {
    primary: style.getPropertyValue('--primary-color').trim(),
    secondary: style.getPropertyValue('--secondary-color').trim(),
    accent: style.getPropertyValue('--accent-color').trim(),
    background: style.getPropertyValue('--background-color').trim(),
    surface: style.getPropertyValue('--surface-color').trim(),
    text: style.getPropertyValue('--text-color').trim(),
    textSecondary: style.getPropertyValue('--text-secondary').trim(),
    border: style.getPropertyValue('--border-color').trim(),
    isDarkMode: document.body.classList.contains('dark-mode')
  };
}

/**
 * Apply custom theme color
 */
function setThemeColor(colorName, colorValue) {
  document.documentElement.style.setProperty(`--${colorName}-color`, colorValue);
  localStorage.setItem(`theme-${colorName}`, colorValue);
}

/**
 * Reset theme to defaults
 */
function resetTheme() {
  // Clear all theme colors from localStorage
  Object.keys(localStorage).forEach(key => {
    if (key.startsWith('theme-')) {
      localStorage.removeItem(key);
    }
  });

  // Remove inline styles
  document.documentElement.style = '';
  initDarkMode();
}

// =============================================
// ANIMATION & TRANSITION UTILITIES
// =============================================

/**
 * Add smooth transitions to elements on mode change
 */
function transitionOnModeChange(elements = null) {
  if (!elements) {
    elements = document.body;
  }

  if (elements instanceof Element) {
    elements.style.transition = 'background-color 0.3s ease, color 0.3s ease';
  } else if (typeof elements === 'string') {
    document.querySelectorAll(elements).forEach(el => {
      el.style.transition = 'background-color 0.3s ease, color 0.3s ease';
    });
  }
}

/**
 * Disable transitions temporarily
 */
function disableTransitions(duration = 300) {
  document.documentElement.style.setProperty('pointer-events', 'none');
  setTimeout(() => {
    document.documentElement.style.setProperty('pointer-events', 'auto');
  }, duration);
}

// =============================================
// ACCESSIBILITY
// =============================================

/**
 * Announce theme change to screen readers
 */
function announceThemeChange() {
  const isDark = document.body.classList.contains('dark-mode');
  const message = isDark ? 'Dark mode enabled' : 'Light mode enabled';

  // Create/find aria-live region
  let liveRegion = document.getElementById('theme-announcement');
  if (!liveRegion) {
    liveRegion = document.createElement('div');
    liveRegion.id = 'theme-announcement';
    liveRegion.setAttribute('aria-live', 'polite');
    liveRegion.setAttribute('aria-atomic', 'true');
    liveRegion.style.position = 'absolute';
    liveRegion.style.left = '-10000px';
    document.body.appendChild(liveRegion);
  }

  liveRegion.textContent = message;
}

// =============================================
// KEYBOARD SHORTCUTS
// =============================================

/**
 * Add keyboard shortcut for dark mode toggle
 * Default: Alt + D (or Cmd + D on Mac)
 */
document.addEventListener('keydown', (e) => {
  const isMac = /Mac|iPhone|iPad|iPod/.test(navigator.platform);
  const isToggleKey = isMac ? (e.metaKey && e.key === 'd') : (e.altKey && e.key === 'd');

  if (isToggleKey && !e.target.matches('input, textarea')) {
    e.preventDefault();
    window.darkMode.toggle();
    announceThemeChange();
  }
});
