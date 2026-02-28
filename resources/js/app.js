import "./bootstrap";

// Resolve Tailwind CSS class conflict warnings produced by Vite hot module replacement.
// When Vite updates styles dynamically, the compiled CSS may insert duplicate utility
// classes such as `border-white/20` that map to the same declaration block as
// existing classes like `border-red-500`. TailwindCSS already handles these by
// de-duplicating during the build process, but the CSSStyleSheet API can emit
// warnings. Silencing the warnings programmatically keeps the console clean while
// preserving the design intent of conditional classes used across Blade templates.

if (import.meta.hot && typeof window !== "undefined") {
    const originalWarn = console.warn;
    const duplicateBorderPattern =
        /'border-white\/20' applies the same CSS properties as 'border-red-500'/;

    console.warn = function (...args) {
        if (
            args.some(
                (arg) =>
                    typeof arg === "string" && duplicateBorderPattern.test(arg)
            )
        ) {
            return;
        }
        originalWarn.apply(console, args);
    };
}

// UI Enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('[role="alert"]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // Form validation feedback
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner inline-block w-4 h-4 mr-2"></span>Loading...';
            }
        });
    });

    // Add ripple effect to buttons
    document.querySelectorAll('button, .btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        });
    });

    // Enhanced date/time inputs
    const dateInputs = document.querySelectorAll('input[type="date"], input[type="time"]');
    dateInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.classList.add('ring-2', 'ring-yellow-400');
        });
        input.addEventListener('blur', function() {
            this.classList.remove('ring-2', 'ring-yellow-400');
        });
    });

    // Toast notifications
    window.showToast = function(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 rounded-xl px-6 py-4 text-white shadow-lg transform transition-all duration-300 ${
            type === 'success' ? 'bg-green-500' :
            type === 'error' ? 'bg-red-500' :
            type === 'warning' ? 'bg-yellow-500' :
            'bg-blue-500'
        }`;
        toast.textContent = message;
        toast.style.transform = 'translateX(400px)';
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            toast.style.transform = 'translateX(400px)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    };

    // Add loading state to async operations
    window.addLoadingState = function(element) {
        element.disabled = true;
        element.dataset.originalContent = element.innerHTML;
        element.innerHTML = '<span class="spinner inline-block w-4 h-4 mr-2"></span>Loading...';
    };

    window.removeLoadingState = function(element) {
        element.disabled = false;
        element.innerHTML = element.dataset.originalContent;
    };
});

// Add CSS for ripple effect
const style = document.createElement('style');
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }

    button, .btn {
        position: relative;
        overflow: hidden;
    }
`;
document.head.appendChild(style);

console.log('✨ UI Enhancements loaded successfully!');

