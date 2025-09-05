@extends('layouts.web')
@section('content')
<style>
.square-img {
	width: 100%;
	aspect-ratio: 1 / 1;
	object-fit: cover;
	display: block;
}

@supports not (aspect-ratio: 1/1) {
	.square-img {
		width: 100%;
		height: 0;
		padding-bottom: 100%;
		object-fit: cover;
	}
	.square-img[style] { 
		padding-bottom: 100%;
	}
}
</style>
<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>Trending now</strong>
                            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    <li class="news-item">Enak dibaca dan enak dimakan.</li>
                                    <li class="news-item">Dunia dalam berita.</li>
                                    <li class="news-item">Meong.</li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="trending-top mb-30">
                            @if($trendingOne)
                                <div class="trend-top-img">
                                    <img src="{{ asset('storage/' . $trendingOne->gambar) }}" 
                                        alt="{{ $trendingOne->judul }}" 
                                        loading="lazy">
                                    <div class="trend-top-cap">
                                        <span>{{ $trendingOne->kategori->nama ?? 'Tanpa Kategori' }}</span>
                                        <h2>
                                            <a href="{{ route('berita.show', $trendingOne->slug) }}">
                                                {{ $trendingOne->judul }}
                                            </a>
                                        </h2>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                @foreach ($berita->take(3) as $item)
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="" class="square-img" loading="lazy">
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <span class="color1">{{ $item->kategori->nama ?? 'Ga masuk kategori, nyet' }}</span>
                                            <h4><a href="{{ route('web.show', $item->slug) }}">{{ $item->judul }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Right Content -->
                    <div class="col-lg-4">
                        <div class="right-content">

                            <h4 class="mb-3">Trending</h4>
                            <div class="list-group mb-4">
                                @foreach($trending as $trend)
                                    <a href="{{ route('berita.show', $trend->slug) }}" 
                                    class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                                        @if($trend->gambar)
                                            <img src="{{ asset('storage/' . $trend->gambar) }}" 
                                                class="rounded" 
                                                style="width: 60px; height: 60px; object-fit: cover;" 
                                                alt="{{ $trend->judul }}">
                                        @endif
                                        <div class="flex-fill">
                                            <h6 class="mb-2" style="margin-left: 10px;">{{ Str::limit($trend->judul, 50) }}</h6> 
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <h4 class="mb-3">Terbaru</h4>
                            <div class="list-group mb-4">
                                @foreach($latest as $news)
                                    <a href="{{ route('berita.show', $news->slug) }}" 
                                    class="list-group-item list-group-item-action d-flex align-items-start gap-3">
                                        @if($news->gambar)
                                            <img src="{{ asset('storage/' . $news->gambar) }}" 
                                                class="rounded" 
                                                style="width: 60px; height: 60px; object-fit: cover;" 
                                                alt="{{ $news->judul }}">
                                        @endif
                                        <div class="flex-fill">
                                            <h6 class="mb-2" style="margin-left: 10px;">{{ Str::limit($news->judul, 50) }}</h6> 
                                            <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <h4 class="mb-3">Kategori</h4>
                            <div class="list-group">
                                @foreach($kategoris as $kat)
                                    <a href="{{ route('web.kategori', $kat->id) }}" 
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        {{ $kat->nama }}
                                        <span class="badge bg-primary rounded-pill">{{ $kat->beritas_count }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->
   <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20" id="ketegori">
        <div class="container">
            <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Whats New</h3>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="properties__button">
                            <!--Nav Button  -->                                            
                            <nav>                                                                     
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                    @php
                                    $kategoriList = App\Models\Kategori::all();
                                    @endphp
                                    @foreach ($kategoriList as $kat)
                                        <a class="nav-item nav-link" href="{{ route('web.kategori', $kat->id) }}">{{ $kat->nama }}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Nav Card -->
                        <div class="tab-content" id="nav-tabContent">
                            <!-- card one -->
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">           
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @foreach ($berita as $item)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img class="square-img" src="storage/{{ $item->gambar }}" alt="">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1">{{ $item->kategori->nama }}</span>
                                                        <h4><a href="{{ route('web.show', $item->slug) }}">{{ $item->judul }}</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- End Nav Card -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Section Tittle -->
                <div class="section-tittle mb-40">
                    <h3>Follow Us</h3>
                </div>
                <!-- Flow Socail -->
                <div class="single-follow mb-45">
                    <div class="single-box">
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a>
                            </div>
                            <div class="follow-count">  
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div> 
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                            <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Poster -->
                <div class="news-poster d-none d-lg-block">
                    <img src="assets/img/news/news_card.png" alt="">
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->
    <!--  Recent Articles start -->
    <div class="recent-articles">
        <div class="container">
           <div class="recent-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Recent Articles</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="recent-active dot-style d-flex dot-style">
                            <div class="single-recent mb-100">
                                <div class="what-img">
                                    <img src="assets/img/news/recent1.jpg" alt="">
                                </div>
                                <div class="what-cap">
                                    <span class="color1">Night party</span>
                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                </div>
                            </div>
                            <div class="single-recent mb-100">
                                <div class="what-img">
                                    <img src="assets/img/news/recent2.jpg" alt="">
                                </div>
                                <div class="what-cap">
                                    <span class="color1">Night party</span>
                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                </div>
                            </div>
                            <div class="single-recent mb-100">
                                <div class="what-img">
                                    <img src="assets/img/news/recent3.jpg" alt="">
                                </div>
                                <div class="what-cap">
                                    <span class="color1">Night party</span>
                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                </div>
                            </div>
                            <div class="single-recent mb-100">
                                <div class="what-img">
                                    <img src="assets/img/news/recent2.jpg" alt="">
                                </div>
                                <div class="what-cap">
                                    <span class="color1">Night party</span>
                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>           
    <!--Recent Articles End -->
    <!--Start pagination -->
    <div class="pagination-area pb-45 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                              <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                              <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                            </ul>
                          </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End pagination  -->
    </main>
    @endsection