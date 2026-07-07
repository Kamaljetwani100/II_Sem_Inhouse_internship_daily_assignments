// ---------- Decorative marigold garland (toran) ----------
// Clones the SVG template into every divider slot on the page.
document.querySelectorAll('[data-toran]').forEach((slot) => {
  const template = document.getElementById('toranTemplate');
  if (template) {
    slot.appendChild(template.content.cloneNode(true));
  }
});

const menuBtn = document.getElementById('menuBtn');
const navLinks = document.getElementById('navLinks');
const authModal = document.getElementById('authModal');
const authOpenBtns = document.querySelectorAll('.auth-open');
const logoutBtn = document.getElementById('logoutBtn');
const closeModal = document.getElementById('closeModal');
const tabBtns = document.querySelectorAll('.tab-btn');
const authForms = document.querySelectorAll('.auth-form');
const userChip = document.getElementById('userChip');

const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const registrationForm = document.getElementById('registrationForm');
const dashboardSection = document.getElementById('dashboard');
const dashboardName = document.getElementById('dashboardName');
const dashboardEmail = document.getElementById('dashboardEmail');
const registrationList = document.getElementById('registrationList');

let users = JSON.parse(localStorage.getItem('pravahUsers') || '{}');
let currentUser = JSON.parse(localStorage.getItem('pravahCurrentUser') || 'null');
let registrations = JSON.parse(localStorage.getItem('pravahRegistrations') || '[]');

function saveUsers() {
  localStorage.setItem('pravahUsers', JSON.stringify(users));
}

function saveRegistrations() {
  localStorage.setItem('pravahRegistrations', JSON.stringify(registrations));
}

function updateAuthButtons() {
  const signedIn = Boolean(currentUser);
  authOpenBtns.forEach((button) => {
    button.style.display = signedIn ? 'none' : 'inline-flex';
  });
  logoutBtn.style.display = signedIn ? 'inline-flex' : 'none';
}

function setCurrentUser(user) {
  currentUser = user;
  if (user) {
    localStorage.setItem('pravahCurrentUser', JSON.stringify(user));
  } else {
    localStorage.removeItem('pravahCurrentUser');
  }
  updateUserChip();
  updateDashboard();
  updateAuthButtons();
}

function updateUserChip() {
  if (currentUser) {
    userChip.textContent = `Namaste, ${currentUser.name}`;
  } else {
    userChip.textContent = 'Guest';
  }
}

function updateDashboard() {
  if (!currentUser) {
    dashboardSection.classList.remove('active');
    dashboardName.textContent = 'Guest';
    dashboardEmail.textContent = 'Not signed in';
    registrationList.innerHTML = '<li class="empty-state">Login and register to see your events here.</li>';
    return;
  }

  dashboardSection.classList.add('active');
  dashboardName.textContent = currentUser.name;
  dashboardEmail.textContent = currentUser.email;

  const userRegistrations = registrations.filter(
    (entry) => entry.email === currentUser.email
  );

  if (!userRegistrations.length) {
    registrationList.innerHTML = '<li class="empty-state">You have not registered for any events yet.</li>';
    return;
  }

  registrationList.innerHTML = userRegistrations
    .map(
      (entry) =>
        `<li><strong>${entry.event}</strong><br>${entry.timestamp}</li>`
    )
    .join('');
}

function selectAuthForm(formId) {
  tabBtns.forEach((tab) => {
    tab.classList.toggle('active', tab.dataset.form === formId);
  });
  authForms.forEach((form) => {
    form.classList.toggle('hidden', form.id !== formId);
  });
}

authOpenBtns.forEach((button) => {
  button.addEventListener('click', () => {
    const target = button.dataset.open;
    authModal.classList.add('show');
    selectAuthForm(target === 'register' ? 'registerForm' : 'loginForm');
  });
});

closeModal.addEventListener('click', () => authModal.classList.remove('show'));

authModal.addEventListener('click', (event) => {
  if (event.target === authModal) {
    authModal.classList.remove('show');
  }
});

tabBtns.forEach((tab) => {
  tab.addEventListener('click', () => {
    selectAuthForm(tab.dataset.form);
  });
});

logoutBtn.addEventListener('click', () => {
  setCurrentUser(null);
  alert('You have been logged out.');
});

loginForm.addEventListener('submit', (event) => {
  event.preventDefault();
  const email = document.getElementById('loginEmail').value.trim().toLowerCase();
  const password = document.getElementById('loginPassword').value;

  if (!email || !password) {
    alert('Please enter your email and password.');
    return;
  }

  if (users[email] && users[email].password === password) {
    setCurrentUser(users[email]);
    alert(`Welcome back, ${users[email].name}!`);
    authModal.classList.remove('show');
    loginForm.reset();
    registerForm.reset();
  } else {
    alert('Login failed. Check your email and password.');
  }
});

registerForm.addEventListener('submit', (event) => {
  event.preventDefault();
  const name = document.getElementById('registerName').value.trim();
  const email = document.getElementById('registerEmail').value.trim().toLowerCase();
  const password = document.getElementById('registerPassword').value;

  if (!name || !email || !password) {
    alert('Please fill in all registration fields.');
    return;
  }

  if (users[email]) {
    alert('An account with this email already exists.');
    return;
  }

  users[email] = { name, email, password };
  saveUsers();
  setCurrentUser(users[email]);
  alert(`Account created. Welcome, ${name}!`);
  authModal.classList.remove('show');
  loginForm.reset();
  registerForm.reset();
});

registrationForm.addEventListener('submit', (event) => {
  event.preventDefault();
  const eventChoice = document.getElementById('eventSelect').value;

  if (!currentUser) {
    alert('Please login or register first to complete event registration.');
    return;
  }

  registrations.push({
    participant: currentUser.name,
    email: currentUser.email,
    event: eventChoice,
    timestamp: new Date().toLocaleString()
  });
  saveRegistrations();

  alert(`Thanks ${currentUser.name}! Your registration for ${eventChoice} is confirmed.`);
  registrationForm.reset();
  updateDashboard();
});

const filterButtons = document.querySelectorAll('.filter-btn');
const scheduleItems = document.querySelectorAll('.schedule-item');

filterButtons.forEach((button) => {
  button.addEventListener('click', () => {
    document.querySelector('.filter-btn.active').classList.remove('active');
    button.classList.add('active');
    const category = button.dataset.category;

    scheduleItems.forEach((item) => {
      const itemCategory = item.dataset.category;
      item.style.display = category === 'all' || itemCategory === category ? 'flex' : 'none';
    });
  });
});

menuBtn.addEventListener('click', () => {
  navLinks.classList.toggle('show');
});

// Close the mobile menu once a destination is picked.
navLinks.querySelectorAll('a').forEach((link) => {
  link.addEventListener('click', () => {
    navLinks.classList.remove('show');
  });
});

// ---------- Gentle reveal-on-scroll for sections ----------
const revealTargets = document.querySelectorAll(
  '.section-heading, .intro-grid, .event-card, .schedule-list, .contact-grid, .dashboard-panel'
);

revealTargets.forEach((el) => el.classList.add('reveal'));

if ('IntersectionObserver' in window) {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15 }
  );

  revealTargets.forEach((el) => observer.observe(el));
} else {
  revealTargets.forEach((el) => el.classList.add('is-visible'));
}

updateUserChip();
updateDashboard();
updateAuthButtons();