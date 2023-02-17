
@php
use App\Models\Track;
use App\Models\Information;
    $information = Information::all()[0];
    $tracks = Track::limit(3)->get();

@endphp
<footer class="text-center text-muted" style="color: #fff!important;">
  <section>
    <div class="container text-center pt-4 text-md-start">
      <div class="row mt-3">
        <div class="col-md-12 col-lg-4 col-xl-3 mb-3">
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fa-solid fa-book-open-reader me-3 text-secondary"></i>Росмолодежь
          </h6>
          <p>
              Проект «IT с неограниченными возможностями» создан командой компании Nethammer совместно с Федеральным агентством по делам молодежи «Росмолодежь»
          </p>

          <a href="{{ route('home') }}" class="mt-4 logo" >
              <img src="{{ asset('images/logo.png') }}" alt="">
          </a>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Быстрые ссылки
          </h6>
          <p><a href="{{ route('about') }}">О проекте</a></p>
          <p><a href="{{ route('posts.index') }}">Новости</a></p>
          <p><a href="{{ route('teams') }}">Команда</a></p>
          </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Направления
          </h6>
          @foreach ($tracks as $track)
            <p>
                <a target="_blank" href="{{ route('tracks.show', $track->slug) }}" class="text-reset">{{ $track->title }}</a>
            </p>
          @endforeach
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Контакты</h6>
          <p><i class="fas fa-home me-3"></i>{{ $information->location }}</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            {{ $information->emails->first()->email }}
          </p>
          <p>
              <a href="{{ asset('rules/rules.pdf') }}" target="_blank">
                  <i class="fas fa-book-reader me-3"></i> Правила проекта
              </a>
          </p>
          <p>
              <a href="{{ asset('rules/policy.pdf') }}" target="_blank">
                  <i class="fas fa-book-reader me-3"></i> Политика конфиденциальности
              </a>
          </p>
        </div>
      </div>
    </div>
  </section>
  <section class="p-4">
    <div class="container">
      <div class="row" style="flex-wrap: wrap">
        <div class="d-lg-flex col-md-8 col-sm-12 mb-4">
          <span class="me-4">Присоединяйтесь к нам в социальных сетях:</span>
          <a target="_blank" href="{{ $information->vk_url }}" class="me-4 icon">
            <i class="fab fa-vk"></i>
          </a>
          <a target="_blank" href="{{ $information->tg_url }}" class="me-4 icon">
            <i class="fab fa-telegram-plane"></i>
          </a>
          <a target="_blank" href="{{ $information->zen_url }}" class="me-4 icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 56 56" fill="none">
                            <path
                                d="M0 28C0 12.536 12.536 0 28 0C43.464 0 56 12.536 56 28C56 43.464 43.464 56 28 56C12.536 56 0 43.464 0 28Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M27.4334 0C27.3011 11.5194 26.5478 17.9662 22.257 22.257C17.9662 26.5478 11.5194 27.3011 0 27.4334V29.1051C11.5194 29.2373 17.9662 29.9906 22.257 34.2814C26.4805 38.5049 27.2766 44.8173 27.4267 56H29.1118C29.2618 44.8173 30.0579 38.5049 34.2814 34.2814C38.5049 30.0579 44.8173 29.2618 56 29.1118V27.4266C44.8173 27.2766 38.5049 26.4805 34.2814 22.257C29.9906 17.9662 29.2373 11.5194 29.1051 0H27.4334Z"
                                fill="#404040" />
                        </svg>
          </a>
        </div>
        <div class="col-md-4 mx-auto ">
           <span>© 2023 Copyright: <a  class="text-reset fw-bold" href="https://nethammer.ru/">Nethammer.ru</a></span>
        </div>
      </div>
    </div>
  </section>
  <div class="text-center p-4">
  </div>
</footer>
