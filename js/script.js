const hamburger = document.getElementById('hamburger');
const mobileNav = document.getElementById('mobile-nav');
const subNav = document.getElementById('sub-nav');

hamburger.addEventListener('click', () => {
    if (window.innerWidth > 768) {
        if (subNav) {
            subNav.classList.toggle('active');
        }
    } else {
        if (mobileNav) {
            mobileNav.classList.toggle('active');
        }
    }
    hamburger.innerHTML = (subNav && subNav.classList.contains('active')) || (mobileNav && mobileNav.classList.contains('active')) 
        ? '<i class="fas fa-times"></i>' 
        : '<i class="fas fa-bars"></i>';
});

document.querySelectorAll('.desktop-nav a, .mobile-nav a, .sub-nav a').forEach(link => {
    link.addEventListener('click', () => {
        if (mobileNav) mobileNav.classList.remove('active');
        if (subNav) subNav.classList.remove('active');
        hamburger.innerHTML = '<i class="fas fa-bars"></i>';
    });
});

window.addEventListener('scroll', () => {
    const header = document.getElementById('header');
    if (window.scrollY > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});

const loginModal = document.getElementById('loginModal');
const signupModal = document.getElementById('signupModal');
const loginBtns = document.querySelectorAll('#loginBtn');
const signupBtns = document.querySelectorAll('#signupBtn');
const closeLogin = document.getElementById('closeLogin');
const closeSignup = document.getElementById('closeSignup');

loginBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        loginModal.style.display = 'block';
        if (mobileNav) mobileNav.classList.remove('active');
        if (subNav) subNav.classList.remove('active');
        hamburger.innerHTML = '<i class="fas fa-bars"></i>';
    });
});

signupBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        signupModal.style.display = 'block';
        if (mobileNav) mobileNav.classList.remove('active');
        if (subNav) subNav.classList.remove('active');
        hamburger.innerHTML = '<i class="fas fa-bars"></i>';
    });
});

closeLogin.addEventListener('click', () => {
    loginModal.style.display = 'none';
});

closeSignup.addEventListener('click', () => {
    signupModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target == loginModal) {
        loginModal.style.display = 'none';
    }
    if (event.target == signupModal) {
        signupModal.style.display = 'none';
    }
});

// FAQ Accordion
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        const isActive = answer.classList.contains('active');
        
        // Close all answers
        document.querySelectorAll('.faq-answer').forEach(ans => {
            ans.classList.remove('active');
        });
        
        // Close all icons
        document.querySelectorAll('.faq-question i').forEach(icon => {
            icon.className = 'fas fa-chevron-down';
        });
        
        // If the clicked answer wasn't active, open it
        if (!isActive) {
            answer.classList.add('active');
            question.querySelector('i').className = 'fas fa-chevron-up';
        }
    });
});

// Edit mechanic
let currentEditingRow = null;

document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        const row = button.closest('tr');
        if (currentEditingRow && currentEditingRow !== row) {
            cancelEdit(currentEditingRow);
        }
        if (button.textContent === 'Edit') {
            startEdit(row);
        } else {
            saveEdit(row);
        }
    });
});

function startEdit(row) {
    currentEditingRow = row;
    row.querySelectorAll('input, textarea').forEach(field => {
        field.removeAttribute('readonly');
    });
    row.querySelector('.edit-btn').textContent = 'Simpan';
}

function cancelEdit(row) {
    row.querySelectorAll('input, textarea').forEach(field => {
        field.setAttribute('readonly', true);
        field.value = field.dataset.original;
    });
    row.querySelector('.edit-btn').textContent = 'Edit';
    currentEditingRow = null;
}

function saveEdit(row) {
    row.querySelector('form').submit();
}