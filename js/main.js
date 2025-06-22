// JS
// Navigacioni menu, filter po kategorijama
document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll("#category-filter .nav-link");
    const posts = document.querySelectorAll(".post-item");
    const noPostsMessage = document.getElementById("no-posts");

    links.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const selectedCategory = this.dataset.category;
            // Ativna klasa
            links.forEach(l => l.classList.remove("active"));
            this.classList.add("active");
            let visibleCount = 0;
            posts.forEach(post => {
                const postCategory = post.dataset.category;

                if (selectedCategory === "all" || postCategory === selectedCategory) {
                    post.style.display = "block";
                    visibleCount++;
                } else {
                    post.style.display = "none";
                }
            });
            if (noPostsMessage) {
                if (visibleCount === 0) {
                    noPostsMessage.style.display = "block";
                    noPostsMessage.textContent = `Nema postova u kategoriji : ${selectedCategory}`;
                } else {
                    noPostsMessage.style.display = "none";
                }
            }
        })
    })
});

// Validacija forme za registraciju
document.getElementById('registerForm').addEventListener('submit', function (e) {
    // Selektovanje elemenata i prikupljanje vrednosti
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const password_confirm = document.getElementById('password_confirm').value.trim();
    const error = document.getElementById('error');

    let errorMsg = '';
    // Validacija i provera unosa da li su polja za unos prazna
    if (!username || !email || !password || !password_confirm) {
        errorMsg = 'Sva polja su obavezna!';
    } else if (password.length < 6) {
        errorMsg = 'Lozinka mora imati minimum 6 karaktera!';
    } else if (password !== password_confirm) {
        errorMsg = 'Lozinke se ne poklapaju!';
    }

    if (errorMsg) {
        e.preventDefault();
        error.textContent = errorMsg;
    }
});


// Login
document.getElementById("loginForm").addEventListener("submit", function (e) {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    let error = '';

    if (!email || !password) {
        error = 'Popunite sva polja';
    }
    if (error) {
        e.preventDefault();
        document.getElementById('loginError').textContent = error;
    }
});





