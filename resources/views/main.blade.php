@extends('layouts.app')

@section('content')

<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-6 align-self-center">
            <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
              <div class="row">
                <div class="col-lg-12">
                  <h2>Help Desk - система учета и управления заявками</h2>
                </div>
                <div class="col-lg-12">
                  <div class="main-green-button scroll-to-section">
                    <a href="#contact">Оставить заявку</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
              <img src="{{ asset('images/banner-right-image.png') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--
<div id="features" class="our-services section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="section-heading wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
          <h2><span>HELP</span>DESK — простой и современный Хелпдеск на <em>русском языке</em></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">
        <div class="service-item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
          <div class="row">
            <div class="col-lg-4">
              <div class="icon">
                <img src="{{ asset('images/service-icon-01.png') }}" alt="">
              </div>
            </div>
            <div class="col-lg-8">
              <div class="right-content">
                <h4>Similar Websites</h4>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dormque laudantium.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="service-item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.4s">
          <div class="row">
            <div class="col-lg-4">
              <div class="icon">
                <img src="{{ asset('images/service-icon-02.png') }}" alt="">
              </div>
            </div>
            <div class="col-lg-8">
              <div class="right-content">
                <h4>Website Trends</h4>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dormque laudantium.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="service-item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.5s">
          <div class="row">
            <div class="col-lg-4">
              <div class="icon">
                <img src="{{ asset('images/service-icon-03.png') }}" alt="">
              </div>
            </div>
            <div class="col-lg-8">
              <div class="right-content">
                <h4>Traffic Analysis</h4>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dormque laudantium.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="service-item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.6s">
          <div class="row">
            <div class="col-lg-4">
              <div class="icon">
                <img src="{{ asset('images/service-icon-03.png') }}" alt="">
              </div>
            </div>
            <div class="col-lg-8">
              <div class="right-content">
                <h4>Optimizing Keywords</h4>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dormque laudantium.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="service-item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.7s">
          <div class="row">
            <div class="col-lg-4">
              <div class="icon">
                <img src="{{ asset('images/service-icon-01.png') }}" alt="">
              </div>
            </div>
            <div class="col-lg-8">
              <div class="right-content">
                <h4>Page Optimizations</h4>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dormque laudantium.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="service-item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.8s">
          <div class="row">
            <div class="col-lg-4">
              <div class="icon">
                <img src="{{ asset('images/service-icon-02.png') }}" alt="">
              </div>
            </div>
            <div class="col-lg-8">
              <div class="right-content">
                <h4>Deep URL Analysis</h4>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dormque laudantium.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
-->

<div id="features" class="features section">
  <div class="container">
    <div class="row">
      <div class="col-lg-5">
        <div class="section-heading wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
          <h2>Процесс подачи <span>заявки</span></h2>
          <h6>Заявку можно подать не заходя в личный кабинет</h6>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="section-heading wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
          <div class="main-green-button scroll-to-section">
            <a href="#contact" class="proccess-ticket">Оставить заявку</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="features-content">
          <div class="row">
            <div class="col-lg-3">
              <div class="features-item first-feature wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
                <div class="first-number number">
                  <h6>01</h6>
                </div>
                <div class="icon"></div>
                <h4>Подача заявки</h4>
                <div class="line-dec"></div>
                <p>Для подачи заявки пользователь заполняет форму, в которой указывает необходимые данные.</p>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="features-item second-feature wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                <div class="second-number number">
                  <h6>02</h6>
                </div>
                <div class="icon"></div>
                <h4>Step 2</h4>
                <div class="line-dec"></div>
                <p>Lorem ipsum dolor sit ameter consectetur adipiscing li elit sed do eiusmod.</p>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="features-item first-feature wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
                <div class="third-number number">
                  <h6>03</h6>
                </div>
                <div class="icon"></div>
                <h4>Step 3</h4>
                <div class="line-dec"></div>
                <p>Lorem ipsum dolor sit ameter consectetur adipiscing li elit sed do eiusmod.</p>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="features-item second-feature last-features-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                <div class="fourth-number number">
                  <h6>04</h6>
                </div>
                <div class="icon"></div>
                <h4>Step 4</h4>
                <div class="line-dec"></div>
                <p>Lorem ipsum dolor sit ameter consectetur adipiscing li elit sed do eiusmod.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="contact" class="contact-us section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
        <form id="contact" action="{{ route('create-ticket') }}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <div class="section-heading">
                <h4 class="color-main-dark">Подать заявку</h4>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="row">
                <div class="col-lg-12">
                    @include('inc.messages')
                </div>
                <div class="col-lg-6">
                  <fieldset>
                    <input type="text" name="name" id="name" placeholder="Имя" value="{{ old('name') }}" required>
                  </fieldset>
                </div>
                <div class="col-lg-6">
                  <fieldset>
                    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                  </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset>
                    <select name="type_id" class="form-control" id="type" required>
                        <option value>Категория заявки</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" @if(old('type_id') === $type->id) selected @endif>
                                {{ $type->code }}
                            </option>
                        @endforeach
                    </select>
                    </fieldset>
                </div>
                <div class="col-lg-6">
                  <fieldset>
                    <input type="subject" name="subject" id="subject" placeholder="Тема сообщения" value="" required>
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <textarea name="message" type="text" class="form-control" id="message" placeholder="Текст сообщения" required=""></textarea>
                  </fieldset>
                </div>
                  {{--            <div class="form-group attachment-block no-error-success-icon" id="attachment-option">--}}
                  {{--                <label>--}}
                  {{--                    <span class="file-label">Добавить вложение</span>--}}
                  {{--                </label>--}}
                  {{--            </div>--}}
                <div class="col-lg-12">
                  <fieldset>
                    <button type="submit" id="form-submit" class="main-button float-left" data-toggle="modal" data-target="#exampleModal">Подать заявку</button>
                  </fieldset>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="contact-info">
                <ul>
                  <li>
                    <div class="icon">
                      <img src="{{ asset('images/contact-icon-01.png') }}" alt="email icon">
                    </div>
                    <a href="#">info@company.com</a>
                  </li>
                  <li>
                    <div class="icon">
                      <img src="{{ asset('images/contact-icon-02.png') }}" alt="phone">
                    </div>
                    <a href="#">+001-002-0034</a>
                  </li>
                  <li>
                    <div class="icon">
                      <img src="{{ asset('images/contact-icon-03.png') }}" alt="location">
                    </div>
                    <a href="#">26th Street, Digital Villa</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <p>Copyright © {{ date('Y') }}. All Rights Reserved.

        <br>Web Designed by GeekBrains students</p>
      </div>
    </div>
  </div>
</footer>

@endsection
