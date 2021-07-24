@extends('layouts.back')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="dashboard-info row">
                        <div class="info-text col-md-6">
                            <h5 class="card-title">Selamat datang, {{ Auth::user()->name }}!</h5>
                            <p>Quote hari ini untuk mu.</p>
                            <blockquote class="blockquote">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                    erat a ante.</p>
                                <footer class="blockquote-footer" style="color:#fffdd0">Someone famous in <cite
                                        title="Source Title">Source Title</cite></footer>
                            </blockquote>
                        </div>
                        <div class="info-image col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="">
                            <h5 class="card-title">Pengunjung Harian</h5>
                            <canvas id="visitorsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Artikel terbaru</h5>
                    <div class="popular-products">
                        <img width="300" height="150" style="object-fit: cover"
                            src="https://images.unsplash.com/photo-1512314889357-e157c22f938d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=751&q=80"
                            alt="">
                        <div class="popular-product-list">
                            <ul class="list-unstyled">
                                <li id="popular-product3">
                                    <a href="#" style="color: darkslategray"><b><span>{{ substr('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus cupiditate quod quam maiores consequuntur praesentium molestias! Cupiditate, facilis quae quam quis similique corporis amet temporibus cumque ad qui illo nihil? ', 0, 50) }}
                                            </span></b> </a>
                                    <span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top"
                                        title="Dibaca">Kategori <i class="fa fa-tags"></i> </span>
                                </li>
                                <li id="popular-product3">
                                    <a href="#" style="color: darkslategray"><b><span>{{ substr('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus cupiditate quod quam maiores consequuntur praesentium molestias! Cupiditate, facilis quae quam quis similique corporis amet temporibus cumque ad qui illo nihil? ', 0, 50) }}
                                            </span></b> </a>
                                    <span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top"
                                        title="Dibaca">Kategori <i class="fa fa-tags"></i> </span>
                                </li>
                                <li id="popular-product3">
                                    <a href="#" style="color: darkslategray"><b><span>{{ substr('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus cupiditate quod quam maiores consequuntur praesentium molestias! Cupiditate, facilis quae quam quis similique corporis amet temporibus cumque ad qui illo nihil? ', 0, 50) }}
                                            </span></b> </a>
                                    <span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top"
                                        title="Dibaca">Kategori <i class="fa fa-tags"></i> </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Artikel terpopuler</h5>
                    <div class="popular-products">
                        <img width="300" height="150" style="object-fit: cover"
                            src="https://images.unsplash.com/photo-1512314889357-e157c22f938d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=751&q=80"
                            alt="">
                        <div class="popular-product-list">
                            <ul class="list-unstyled">
                                <li id="popular-product3">
                                    <a href="#" style="color: darkslategray"><b><span>{{ substr('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus cupiditate quod quam maiores consequuntur praesentium molestias! Cupiditate, facilis quae quam quis similique corporis amet temporibus cumque ad qui illo nihil? ', 0, 50) }}
                                            </span></b> </a>
                                    <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top"
                                        title="Dibaca">15.000.000 <i class="fa fa-eye"></i> </span>
                                </li>
                                <li id="popular-product3">
                                    <a href="#" style="color: darkslategray"><b><span>{{ substr('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus cupiditate quod quam maiores consequuntur praesentium molestias! Cupiditate, facilis quae quam quis similique corporis amet temporibus cumque ad qui illo nihil? ', 0, 50) }}
                                            </span></b> </a>
                                    <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top"
                                        title="Dibaca">15.000.000 <i class="fa fa-eye"></i> </span>
                                </li>
                                <li id="popular-product3">
                                    <a href="#" style="color: darkslategray"><b><span>{{ substr('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus cupiditate quod quam maiores consequuntur praesentium molestias! Cupiditate, facilis quae quam quis similique corporis amet temporibus cumque ad qui illo nihil? ', 0, 50) }}
                                            </span></b> </a>
                                    <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top"
                                        title="Dibaca">15.000.000 <i class="fa fa-eye"></i> </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kontak</h5>
                    <div class="social-media-list">
                        <div class="social-media-item">
                            <div class="social-icon " style="background-color: rgb(225,48,108)">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="social-text" >
                                <p><a href="https://instagram.com/inimahsumedang" target="_blank">inimahsumedang</a></p>
                                <span>Instagram</span>
                            </div>
                        </div>
                        <div class="social-media-item">
                            <div class="social-icon facebook">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="social-text">
                                <p>Inimahsumedang</p>
                                <span>Facebook</span>
                            </div>
                        </div>
                        <div class="social-media-item">
                            <div class="social-icon twitter">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="social-text">
                                <p>inimahsumedang</p>
                                <span>Twitter</span>
                            </div>
                        </div>
                        <div class="social-media-item">
                            <div class="social-icon bg-success">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="social-text">
                                <p>085156574497</p>
                                <span>Whatsapp</span>
                            </div>
                        </div>
                        <div class="social-media-item">
                            <div class="social-icon google">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="social-text">
                                <p><a href="mailto:inimahsumedang@gmail.com">inimahsumedang@gmail.com</a> </p>
                                <span>Email</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/back/js/pages/dashboard.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // DOM elements
            const quote = document.querySelector(".blockquote p");
            const cite = document.querySelector(".blockquote .blockquote-footer");

            async function updateQuote() {
                // Fetch a random quote from the Quotable API
                const response = await fetch("https://api.quotable.io/random");
                const data = await response.json();
                if (response.ok) {
                    // Update DOM elements
                    quote.textContent = data.content;
                    cite.textContent = data.author;
                } else {
                    quote.textContent = "An error occured";
                }
            }

            // call updateQuote once when page loads
            updateQuote();
        });
    </script>
@endsection
