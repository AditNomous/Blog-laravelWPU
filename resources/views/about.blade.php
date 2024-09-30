<x-layout>

  
    <div class="container">
        <!-- Bagian About Author -->
        <div class="about-author">
            <h2>About the Author</h2>
            <div class="author-info">
                <!-- Div untuk Foto dan Motto Author -->
                <div class="author-photo">
                    <img src="{{ asset('images/author.jpg') }}" alt="Author Photo" class="rounded-circle" width="150">
                </div>
                <div class="author-motto">
                    <p>"Inspiring others through technology and creativity"</p>
                </div>
            </div>
    
            <!-- Bagian Kontak -->
            <div class="contact-info mt-4">
                <h3>Contact Me</h3>
                <ul class="social-media-list">
                    <li><a href="https://facebook.com/yourusername" target="_blank">Facebook</a></li>
                    <li><a href="https://instagram.com/yourusername" target="_blank">Instagram</a></li>
                    <li><a href="https://twitter.com/yourusername" target="_blank">Twitter</a></li>
                    <li><a href="https://youtube.com/yourusername" target="_blank">YouTube</a></li>
                    <li><a href="https://www.tiktok.com/@yourusername" target="_blank">TikTok</a></li>
                    <li><a href="https://wa.me/1234567890" target="_blank">WhatsApp</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Optional CSS Styling -->
    <style>
        .about-author {
            text-align: center;
            margin-top: 50px;
        }
        
        .author-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .author-photo img {
            border-radius: 50%;
            margin-bottom: 15px;
        }
    
        .author-motto p {
            font-size: 1.2rem;
            font-style: italic;
            color: #555;
        }
    
        .contact-info {
            margin-top: 20px;
        }
        
        .social-media-list {
            list-style: none;
            padding: 0;
        }
        
        .social-media-list li {
            display: inline;
            margin-right: 15px;
        }
        
        .social-media-list li a {
            text-decoration: none;
            color: #007bff;
            font-size: 1.1rem;
        }
    
        .social-media-list li a:hover {
            text-decoration: underline;
        }
    </style>

  </x-layout>