/**
 * ====================================================================
 * CORE APPLICATION JAVASCRIPT (app.js)
 * ====================================================================
 * Description: Modular JavaScript controlling template interactions:
 * - Responsive sidebar toggle (Desktop mini-mode & Mobile offcanvas)
 * - Accordion dropdown sub-menus
 * - Light / Dark Theme switching with localStorage persistence
 * - Fullscreen toggle
 * - Mobile search expansion
 * - Active state handling and responsive listeners
 * ====================================================================
 */

document.addEventListener('DOMContentLoaded', () => {
  'use strict';

  // ------------------------------------------------------------------
  // 1. SELECTORS & DOM ELEMENTS
  // ------------------------------------------------------------------
  const body = document.body;
  const sidebarToggleBtns = document.querySelectorAll('.btn-sidebar-toggle');
  const sidebarBackdrop = document.getElementById('sidebarBackdrop');
  const themeToggleBtn = document.getElementById('themeToggleBtn');
  const fullscreenToggleBtn = document.getElementById('fullscreenToggleBtn');
  const mobileSearchBtn = document.getElementById('mobileSearchBtn');
  const headerSearch = document.getElementById('headerSearch');
  const sidebarDropdownToggles = document.querySelectorAll('[data-sidebar-toggle="dropdown"]');

  const DESKTOP_BREAKPOINT = 992; // 992px Bootstrap breakpoint

  // ------------------------------------------------------------------
  // 2. THEME CONTROLLER (LIGHT / DARK MODE)
  // ------------------------------------------------------------------
  const STORAGE_KEY_THEME = 'app_theme_mode';

  const initTheme = () => {
    const savedTheme = localStorage.getItem(STORAGE_KEY_THEME);
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialTheme = savedTheme || (prefersDark ? 'dark' : 'light');

    setTheme(initialTheme);
  };

  const setTheme = (theme) => {
    document.documentElement.setAttribute('data-theme', theme);
    document.documentElement.setAttribute('data-bs-theme', theme);
    localStorage.setItem(STORAGE_KEY_THEME, theme);

    // Update icon in theme toggle button if present
    if (themeToggleBtn) {
      const icon = themeToggleBtn.querySelector('i');
      if (icon) {
        if (theme === 'dark') {
          icon.className = 'bi bi-sun-fill text-warning';
          themeToggleBtn.setAttribute('title', 'Switch to Light Mode');
        } else {
          icon.className = 'bi bi-moon-stars-fill';
          themeToggleBtn.setAttribute('title', 'Switch to Dark Mode');
        }
      }
    }
  };

  if (themeToggleBtn) {
    themeToggleBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      setTheme(newTheme);
    });
  }

  // ------------------------------------------------------------------
  // 3. RESPONSIVE SIDEBAR TOGGLE (DESKTOP COLLAPSE & MOBILE OFFCANVAS)
  // ------------------------------------------------------------------
  const toggleSidebar = () => {
    const windowWidth = window.innerWidth;

    if (windowWidth >= DESKTOP_BREAKPOINT) {
      // Desktop / Laptop: Toggle Mini Collapsed Mode
      body.classList.toggle('sidebar-collapsed');
      const isCollapsed = body.classList.contains('sidebar-collapsed');
      localStorage.setItem('sidebar_desktop_collapsed', isCollapsed ? 'true' : 'false');
    } else {
      // Mobile / Tablet: Toggle Offcanvas Slide Drawer
      body.classList.toggle('sidebar-open');
    }
  };

  const closeMobileSidebar = () => {
    if (body.classList.contains('sidebar-open')) {
      body.classList.remove('sidebar-open');
    }
  };

  // Attach click listener to all sidebar toggle buttons (header / brand)
  sidebarToggleBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      toggleSidebar();
    });
  });

  // Clicking outside sidebar on mobile closes the drawer
  if (sidebarBackdrop) {
    sidebarBackdrop.addEventListener('click', () => {
      closeMobileSidebar();
    });
  }

  // Restore Desktop Sidebar preference
  const savedDesktopState = localStorage.getItem('sidebar_desktop_collapsed');
  if (window.innerWidth >= DESKTOP_BREAKPOINT && savedDesktopState === 'true') {
    body.classList.add('sidebar-collapsed');
  }

  // ------------------------------------------------------------------
  // 4. SIDEBAR ACCORDION DROPDOWN SUBMENUS
  // ------------------------------------------------------------------
  sidebarDropdownToggles.forEach((toggle) => {
    toggle.addEventListener('click', (e) => {
      e.preventDefault();

      const parentItem = toggle.closest('.nav-item');
      const targetSubmenu = parentItem ? parentItem.querySelector('.sidebar-submenu') : null;
      if (!targetSubmenu) return;

      const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

      // Optional: Close sibling dropdowns (Accordion behavior)
      const siblingToggles = toggle.closest('.sidebar-nav')?.querySelectorAll('[data-sidebar-toggle="dropdown"]');
      siblingToggles?.forEach((otherToggle) => {
        if (otherToggle !== toggle) {
          otherToggle.setAttribute('aria-expanded', 'false');
          const otherSubmenu = otherToggle.closest('.nav-item')?.querySelector('.sidebar-submenu');
          if (otherSubmenu) {
            otherSubmenu.style.display = 'none';
          }
        }
      });

      // Toggle current dropdown
      if (isExpanded) {
        toggle.setAttribute('aria-expanded', 'false');
        targetSubmenu.style.display = 'none';
      } else {
        toggle.setAttribute('aria-expanded', 'true');
        targetSubmenu.style.display = 'flex';
      }
    });
  });

  // Automatically expand parent dropdown if an inner submenu link is active
  const activeSubmenuLinks = document.querySelectorAll('.sidebar-submenu .submenu-link.active');
  activeSubmenuLinks.forEach((link) => {
    const parentSubmenu = link.closest('.sidebar-submenu');
    const parentToggle = link.closest('.nav-item')?.querySelector('[data-sidebar-toggle="dropdown"]');
    if (parentSubmenu && parentToggle) {
      parentToggle.setAttribute('aria-expanded', 'true');
      parentSubmenu.style.display = 'flex';
    }
  });

  // ------------------------------------------------------------------
  // 5. FULLSCREEN TOGGLE
  // ------------------------------------------------------------------
  if (fullscreenToggleBtn) {
    fullscreenToggleBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const icon = fullscreenToggleBtn.querySelector('i');

      if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().then(() => {
          if (icon) icon.className = 'bi bi-fullscreen-exit';
        }).catch(err => {
          console.warn(`Fullscreen error: ${err.message}`);
        });
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen().then(() => {
            if (icon) icon.className = 'bi bi-arrows-fullscreen';
          });
        }
      }
    });

    document.addEventListener('fullscreenchange', () => {
      const icon = fullscreenToggleBtn.querySelector('i');
      if (icon) {
        icon.className = document.fullscreenElement ? 'bi bi-fullscreen-exit' : 'bi bi-arrows-fullscreen';
      }
    });
  }

  // ------------------------------------------------------------------
  // 6. MOBILE SEARCH BAR TOGGLE
  // ------------------------------------------------------------------
  if (mobileSearchBtn && headerSearch) {
    mobileSearchBtn.addEventListener('click', (e) => {
      e.preventDefault();
      headerSearch.classList.toggle('mobile-visible');
      if (headerSearch.classList.contains('mobile-visible')) {
        const input = headerSearch.querySelector('input');
        if (input) input.focus();
      }
    });
  }

  // ------------------------------------------------------------------
  // 7. RESPONSIVE WINDOW RESIZE OBSERVER
  // ------------------------------------------------------------------
  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      const width = window.innerWidth;
      // Close mobile drawer when resizing back to desktop
      if (width >= DESKTOP_BREAKPOINT) {
        closeMobileSidebar();
        if (headerSearch) {
          headerSearch.classList.remove('mobile-visible');
        }
      }
    }, 150);
  });

  // ------------------------------------------------------------------
  // 8. INITIALIZE BOOTSTRAP TOOLTIPS & POPOVERS (IF BOOTSTRAP EXISTS)
  // ------------------------------------------------------------------
  if (typeof bootstrap !== 'undefined') {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  }

  // ------------------------------------------------------------------
  // 9. PASSWORD VISIBILITY TOGGLER
  // ------------------------------------------------------------------
  const passwordToggleBtns = document.querySelectorAll('.password-toggle-btn');
  passwordToggleBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const wrapper = btn.closest('.input-group') || btn.closest('.password-input-wrapper');
      const input = wrapper ? wrapper.querySelector('input') : null;
      const icon = btn.querySelector('i');
      if (!input || !icon) return;

      if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash-fill';
      } else {
        input.type = 'password';
        icon.className = 'bi bi-eye-fill';
      }
    });
  });

  // ------------------------------------------------------------------
  // 10. PASSWORD STRENGTH METER
  // ------------------------------------------------------------------
  const passwordInputs = document.querySelectorAll('[data-password-meter]');
  passwordInputs.forEach((input) => {
    input.addEventListener('input', () => {
      const val = input.value;
      const meterBar = document.querySelector('.password-meter-bar');
      if (!meterBar) return;

      meterBar.className = 'password-meter-bar';
      if (val.length === 0) {
        meterBar.style.width = '0%';
      } else if (val.length < 6) {
        meterBar.classList.add('weak');
      } else if (val.length < 10 || !/[A-Z]/.test(val) || !/[0-9]/.test(val)) {
        meterBar.classList.add('medium');
      } else {
        meterBar.classList.add('strong');
      }
    });
  });

  // ------------------------------------------------------------------
  // 11. AVATAR UPLOAD IMAGE PREVIEW
  // ------------------------------------------------------------------
  const avatarFileInput = document.getElementById('employeeAvatarInput');
  const avatarPreviewImg = document.getElementById('avatarPreviewImg');
  const avatarPlaceholder = document.getElementById('avatarPlaceholder');

  if (avatarFileInput && avatarPreviewImg && avatarPlaceholder) {
    avatarFileInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(evt) {
          avatarPreviewImg.src = evt.target.result;
          avatarPreviewImg.style.display = 'block';
          avatarPlaceholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
      }
    });
  }

  // ------------------------------------------------------------------
  // 12. DEMO LOGIN AUTOFILL
  // ------------------------------------------------------------------
  const demoAdminBtn = document.getElementById('demoAdminBtn');
  const demoUserBtn = document.getElementById('demoUserBtn');
  const loginEmailInput = document.getElementById('loginEmail');
  const loginPasswordInput = document.getElementById('loginPassword');

  if (demoAdminBtn && loginEmailInput && loginPasswordInput) {
    demoAdminBtn.addEventListener('click', (e) => {
      e.preventDefault();
      loginEmailInput.value = 'admin@adminhub.com';
      loginPasswordInput.value = 'AdminPass@2026';
    });
  }

  if (demoUserBtn && loginEmailInput && loginPasswordInput) {
    demoUserBtn.addEventListener('click', (e) => {
      e.preventDefault();
      loginEmailInput.value = 'employee@adminhub.com';
      loginPasswordInput.value = 'EmpPass@2026';
    });
  }

  // ------------------------------------------------------------------
  // 13. MULTI-STEP EMPLOYEE FORM WIZARD CONTROLLER
  // ------------------------------------------------------------------
  const employeeForm = document.getElementById('employeeForm');
  const btnPrevStep = document.getElementById('btnPrevStep');
  const btnNextStep = document.getElementById('btnNextStep');
  const btnSubmitForm = document.getElementById('btnSubmitForm');
  const stepperProgressLine = document.getElementById('stepperProgressLine');
  const stepperItems = document.querySelectorAll('.stepper-item');
  const stepPanes = document.querySelectorAll('.form-step-pane');
  const currentStepTitle = document.getElementById('currentStepTitle');
  const currentStepSubtitle = document.getElementById('currentStepSubtitle');
  const badgeStepCount = document.getElementById('badgeStepCount');

  const stepMeta = {
    1: {
      title: 'Step 1: Primary & Personal Information',
      subtitle: 'Fill in the basic personal profile details and upload an avatar photo.',
    },
    2: {
      title: 'Step 2: Contact Details & Residential Address',
      subtitle: 'Provide active communication channels and residential location.',
    },
    3: {
      title: 'Step 3: Professional & Employment Details',
      subtitle: 'Assign department, designation, salary compensation, and system role.',
    },
    4: {
      title: 'Step 4: Review & Final Confirmation',
      subtitle: 'Review all submitted employee onboarding data before finalizing.',
    }
  };

  let currentStep = 1;
  const totalSteps = 4;

  function updateStepperUI(step) {
    currentStep = step;

    // 1. Update Connecting Progress Bar
    if (stepperProgressLine) {
      const percentage = ((step - 1) / (totalSteps - 1)) * 100;
      stepperProgressLine.style.width = percentage + '%';
    }

    // 2. Update Stepper Node Circles
    stepperItems.forEach((item, index) => {
      const stepNumber = index + 1;
      const circle = item.querySelector('.stepper-circle');

      item.classList.remove('active', 'completed');

      if (stepNumber < step) {
        item.classList.add('completed');
        if (circle) circle.innerHTML = '<i class="bi bi-check-lg text-white"></i>';
      } else if (stepNumber === step) {
        item.classList.add('active');
        if (circle) circle.textContent = stepNumber;
      } else {
        if (circle) circle.textContent = stepNumber;
      }
    });

    // 3. Switch Step Panes
    stepPanes.forEach((pane) => {
      const paneStep = parseInt(pane.getAttribute('data-step'), 10);
      if (paneStep === step) {
        pane.classList.add('active');
      } else {
        pane.classList.remove('active');
      }
    });

    // 4. Update Header Titles & Badge
    if (stepMeta[step]) {
      if (currentStepTitle) currentStepTitle.textContent = stepMeta[step].title;
      if (currentStepSubtitle) currentStepSubtitle.textContent = stepMeta[step].subtitle;
      if (badgeStepCount) badgeStepCount.textContent = `Step ${step} of ${totalSteps}`;
    }

    // 5. Update Navigation Buttons
    if (btnPrevStep) {
      if (step === 1) {
        btnPrevStep.classList.add('d-none');
      } else {
        btnPrevStep.classList.remove('d-none');
      }
    }

    if (btnNextStep && btnSubmitForm) {
      if (step === totalSteps) {
        btnNextStep.classList.add('d-none');
        btnSubmitForm.classList.remove('d-none');
        populateReviewSummary();
      } else {
        btnNextStep.classList.remove('d-none');
        btnSubmitForm.classList.add('d-none');
      }
    }

    // Smooth scroll to top of form card
    const formCard = document.querySelector('.card-custom');
    if (formCard) {
      formCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
  }

  // Populate Step 4 Summary Card with Live Values
  function populateReviewSummary() {
    const firstName = document.getElementById('firstName')?.value || 'Alex';
    const lastName = document.getElementById('lastName')?.value || 'Taylor';
    const email = document.getElementById('workEmail')?.value || 'alex.taylor@company.com';
    const phone = document.getElementById('phoneNumber')?.value || '+1 (555) 019-2834';
    const deptSelect = document.getElementById('department');
    const department = deptSelect ? deptSelect.options[deptSelect.selectedIndex]?.text : 'Engineering & Tech';
    const jobTitle = document.getElementById('jobTitle')?.value || 'Senior Frontend Engineer';
    const joiningDate = document.getElementById('joiningDate')?.value || '2026-09-01';
    const salary = document.getElementById('salary')?.value || '115000';

    const reviewFullName = document.getElementById('reviewFullName');
    const reviewEmail = document.getElementById('reviewEmail');
    const reviewPhone = document.getElementById('reviewPhone');
    const reviewDepartment = document.getElementById('reviewDepartment');
    const reviewRole = document.getElementById('reviewRole');
    const reviewJoiningDate = document.getElementById('reviewJoiningDate');
    const reviewSalary = document.getElementById('reviewSalary');

    if (reviewFullName) reviewFullName.textContent = `${firstName} ${lastName}`;
    if (reviewEmail) reviewEmail.textContent = email;
    if (reviewPhone) reviewPhone.textContent = phone;
    if (reviewDepartment) reviewDepartment.textContent = department;
    if (reviewRole) reviewRole.textContent = jobTitle;
    if (reviewJoiningDate) reviewJoiningDate.textContent = joiningDate;
    if (reviewSalary) reviewSalary.textContent = `$${parseInt(salary, 10).toLocaleString()} / yr`;
  }

  // Validate fields in the active pane
  function validateActiveStep(step) {
    const activePane = document.querySelector(`.form-step-pane[data-step="${step}"]`);
    if (!activePane) return true;

    const requiredInputs = activePane.querySelectorAll('input[required], select[required]');
    let isValid = true;

    requiredInputs.forEach((input) => {
      if (!input.checkValidity() || input.value.trim() === '') {
        input.classList.add('is-invalid');
        isValid = false;
      } else {
        input.classList.remove('is-invalid');
      }
    });

    return isValid;
  }

  // Next Step Click Handler
  if (btnNextStep) {
    btnNextStep.addEventListener('click', (e) => {
      e.preventDefault();
      if (validateActiveStep(currentStep)) {
        if (currentStep < totalSteps) {
          updateStepperUI(currentStep + 1);
        }
      }
    });
  }

  // Previous Step Click Handler
  if (btnPrevStep) {
    btnPrevStep.addEventListener('click', (e) => {
      e.preventDefault();
      if (currentStep > 1) {
        updateStepperUI(currentStep - 1);
      }
    });
  }

  // Stepper Node Circle Click Handler
  stepperItems.forEach((item) => {
    item.addEventListener('click', () => {
      const targetStep = parseInt(item.getAttribute('data-step-target'), 10);
      if (targetStep < currentStep) {
        updateStepperUI(targetStep);
      } else if (targetStep === currentStep + 1 && validateActiveStep(currentStep)) {
        updateStepperUI(targetStep);
      }
    });
  });

  // Final Submit Handler with Spinner & Automatic Redirection to Directory
  if (btnSubmitForm) {
    btnSubmitForm.addEventListener('click', (e) => {
      e.preventDefault();
      
      btnSubmitForm.disabled = true;
      btnSubmitForm.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving Employee Record...';

      setTimeout(() => {
        window.location.href = 'employee-list.html';
      }, 700);
    });
  }

  // Initialize theme on load
  initTheme();
});
