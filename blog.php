<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog — Hello Pokhara</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --brand: #023e8a;
            --brand-light: #0077b6;
            --muted: #f8f9fa;
            --accent: #007bff;
            --text: #333;
            --light-text: #666;
            --border: #e9ecef;
        }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fff;
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .blog-header {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .blog-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .blog-header p {
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }

        /* Blog Layout */
        .blog-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
            margin: 50px 0;
        }

        /* Featured Post */
        .featured-post {
            margin-bottom: 50px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .featured-post img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }

        .featured-content {
            padding: 30px;
            background: white;
        }

        .post-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: var(--light-text);
        }

        .post-meta i {
            margin-right: 5px;
        }

        .featured-content h2 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: var(--brand);
        }

        .featured-content p {
            margin-bottom: 20px;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--brand);
            font-weight: 600;
            text-decoration: none;
            padding: 8px 16px;
            border: 1px solid var(--brand);
            border-radius: 6px;
            transition: all 0.3s;
        }

        .read-more:hover {
            background: var(--brand);
            color: white;
        }

        /* Blog Grid */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .blog-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .blog-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-card-content {
            padding: 20px;
        }

        .blog-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--brand);
        }

        .blog-card p {
            font-size: 0.95rem;
            color: var(--light-text);
            margin-bottom: 15px;
        }

        /* Sidebar */
        .sidebar {
            background: var(--muted);
            padding: 25px;
            border-radius: 12px;
            height: fit-content;
        }

        .sidebar-section {
            margin-bottom: 30px;
        }

        .sidebar-section:last-child {
            margin-bottom: 0;
        }

        .sidebar-section h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--brand);
            padding-bottom: 8px;
            border-bottom: 2px solid var(--border);
        }

        .categories-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .categories-list li {
            margin-bottom: 10px;
        }

        .categories-list a {
            color: var(--text);
            text-decoration: none;
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            transition: color 0.2s;
        }

        .categories-list a:hover {
            color: var(--brand);
        }

        .categories-list span {
            background: var(--brand);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag {
            background: white;
            color: var(--brand);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            text-decoration: none;
            border: 1px solid var(--border);
            transition: all 0.2s;
        }

        .tag:hover {
            background: var(--brand);
            color: white;
        }

        /* Newsletter */
        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .newsletter-form input {
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 0.95rem;
        }

        .newsletter-form button {
            background: var(--brand);
            color: white;
            border: none;
            padding: 10px 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .newsletter-form button:hover {
            background: var(--brand-light);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .blog-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .blog-grid {
                grid-template-columns: 1fr;
            }
            
            .featured-post img {
                height: 250px;
            }
            
            .blog-header h1 {
                font-size: 2rem;
            }
        }

        /* Navigation (placeholder) */
        .main-nav {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--brand);
        }

        .logo img {
            height: 40px;
        }

        /* Footer */
        .site-footer {
            background: var(--brand);
            color: white;
            padding: 50px 0 20px;
            margin-top: 50px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-section h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 0.9rem;
            color: rgba(255,255,255,0.7);
        }

        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
   <!-- Navigation placeholder -->
  <?php include 'nav.php'; ?>
  
  <div class="wrap">
    <div class="contact-grid"></div>
    <!-- Blog Header -->
    <header class="blog-header">
        <div class="container">
            <h1>Hello Pokhara Blog</h1>
            <p>Travel tips, local insights, and stories from the heart of Nepal</p>
        </div>
    </header>

    <!-- Blog Content -->
    <main class="container">
        <div class="blog-container">
            <!-- Main Content -->
            <div class="blog-main">
                <!-- Featured Post -->
                <article class="featured-post">
                    <img src="para.jpg" alt="Paragliding in Pokhara">
                    <div class="featured-content">
                        <div class="post-meta">
                            <span><i class="far fa-calendar"></i> March 15, 2025</span>
                            <span><i class="far fa-user"></i> By Sajan</span>
                            <span><i class="far fa-folder"></i> Adventure</span>
                        </div>
                        <h2>Paragliding in Pokhara: Soaring Above the Annapurna Range</h2>
                        <p>Experience the thrill of flying like a bird as you soar above the stunning landscapes of Pokhara. In this comprehensive guide, we cover everything you need to know about paragliding in one of the world's best destinations for this adventure sport.</p>
                    </div>
                </article>

                <!-- Blog Grid -->
                <div class="blog-grid">
                    <!-- Blog Post 1 -->
                    <article class="blog-card">
                        <img src="pokara.jpg" alt="Exploring Fewa Lake">
                        <div class="blog-card-content">
                            <div class="post-meta">
                                <span><i class="far fa-calendar"></i> March 10, 2025</span>
                            </div>
                            <h3>Exploring Fewa Lake: A Complete Guide</h3>
                            <p>Discover the best spots around Fewa Lake for boating, photography, and relaxation. Learn about the hidden gems that most tourists miss.</p>
                        </div>
                    </article>

                    <!-- Blog Post 2 -->
                    <article class="blog-card">
                    <img src="dal.jpg" alt="Nepali cuisine">
                        <div class="blog-card-content">
                            <div class="post-meta">
                                <span><i class="far fa-calendar"></i> March 5, 2025</span>
                            </div>
                            <h3>A Food Lover's Guide to Nepali Cuisine</h3>
                            <p>From momos to dal bhat, explore the rich flavors of Nepali food and where to find the best local dishes in Pokhara.</p>
                        </div>
                    </article>

                    <!-- Blog Post 3 -->
                    <article class="blog-card">
                        <img src="terk.jpg" alt="Trekking in Annapurna">
                        <div class="blog-card-content">
                            <div class="post-meta">
                                <span><i class="far fa-calendar"></i> February 28, 2025</span>
                            </div>
                            <h3>Annapurna Base Camp Trek: What to Expect</h3>
                            <p>Planning to trek to ABC? Here's everything you need to know about the route, difficulty, and what to pack for this incredible journey.</p>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- About Section -->
                <div class="sidebar-section">
                    <h3>About Our Blog</h3>
                    <p>Welcome to the Hello Pokhara blog! We share travel tips, local insights, and stories to help you make the most of your visit to this beautiful region of Nepal.</p>
                </div>

                <!-- Categories -->
                <div class="sidebar-section">
                    <h3>Categories</h3>
                    <ul class="categories-list">
                        <li><a href="#">Adventure <span>8</span></a></li>
                        <li><a href="#">Culture <span>12</span></a></li>
                        <li><a href="#">Food & Drink <span>6</span></a></li>
                        <li><a href="#">Travel Tips <span>10</span></a></li>
                        <li><a href="#">Accommodation <span>5</span></a></li>
                    </ul>
                </div>

                <!-- Tags -->
                <div class="sidebar-section">
                    <h3>Popular Tags</h3>
                    <div class="tags">
                        <a href="#" class="tag">Adventure</a>
                        <a href="#" class="tag">Trekking</a>
                        <a href="#" class="tag">Food</a>
                        <a href="#" class="tag">Culture</a>
                        <a href="#" class="tag">Photography</a>
                        <a href="#" class="tag">Budget Travel</a>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="sidebar-section">
                    <h3>Newsletter</h3>
                    <p>Subscribe to get travel tips and updates directly in your inbox.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </aside>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'footer.php' ?>
                       
    <script>
        // Newsletter form submission
        const newsletterForm = document.querySelector('.newsletter-form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const email = newsletterForm.querySelector('input[type="email"]').value;
                alert(`Thank you for subscribing with ${email}! You'll receive our next update soon.`);
                newsletterForm.reset();
            });
        }
    </script>
</body>
</html>