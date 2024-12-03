document.addEventListener("DOMContentLoaded", function() {

    // Handle the menu navigation clicks
    const navItems = document.querySelectorAll('.nav-item, .nav-item-1');
    navItems.forEach(item => {
        item.addEventListener('click', function(event) {
            const label = item.querySelector('.label, .label-1').textContent;
            console.log(`Navigating to: ${label}`);
            // Example: You could update the URL or show/hide content dynamically
        });
    });

    // Handle the log out click event
    const logOutBtn = document.querySelector('.nav-item-7');
    if (logOutBtn) {
        logOutBtn.addEventListener('click', function(event) {
            // Perform log out action, e.g., clearing session storage, redirecting
            console.log('Logging out...');
            window.location.href = '/login.html'; // Redirect to login page
        });
    }

    // Handle the performance chart update (e.g., update progress bar)
    const progressBar = document.querySelector('.progress');
    const progressPercentage = document.querySelector('.number');
    
    if (progressBar && progressPercentage) {
        // Update progress bar to 12%
        const percentage = 12;  // You could replace this with dynamic data
        progressPercentage.textContent = `${percentage}%`;

        // Add progress visualization (if progress is in an image format)
        progressBar.style.width = `${percentage}%`;
    }

    // Dropdown Menu Interaction (e.g., for 'Jane Doe' user info)
    const dropdownMenu = document.querySelector('.dropdown-menu-variant23');
    if (dropdownMenu) {
        dropdownMenu.addEventListener('click', function(event) {
            const userName = dropdownMenu.querySelector('p').textContent.trim();
            console.log(`User: ${userName} clicked the dropdown`);
            // Example: You can show additional info or manage session state
        });
    }

    // Handle navigation links with dynamic content loading
    const navLinks = document.querySelectorAll('a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetPage = link.getAttribute('href');
            console.log(`Navigating to page: ${targetPage}`);
            // Here you could use AJAX to load content or redirect to new page
            window.location.href = targetPage; // Simple navigation
        });
    });

    // Optional: Toggling visibility of sections (for example, showing performance details)
    const performanceSection = document.querySelector('.chart');
    const togglePerformanceBtn = document.querySelector('.menu-fab');
    if (togglePerformanceBtn && performanceSection) {
        togglePerformanceBtn.addEventListener('click', function(event) {
            performanceSection.classList.toggle('hidden');
            console.log('Toggling performance chart visibility');
        });
    }

});