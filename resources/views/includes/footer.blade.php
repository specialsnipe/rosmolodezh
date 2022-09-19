
@php
use App\Models\Information;
    $information = Information::all()[0];
@endphp
<footer class="text-center text-muted" style="color: #fff!important;">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <div class="me-5 d-none d-lg-block">
      <span>Присоединяйтесь к нам в социальных сетях:</span>
    </div>

    <div>
      <a href="{{ $information->vk_url }}" class="me-4 icon">
        <i class="fab fa-vk"></i>
      </a>
      <a href="https://t.me/{{ $information->tg_url }}" class="me-4 icon">
        <i class="fab fa-telegram-plane"></i>
      </a>
      <a href="{{ $information->zen_url }}" class="me-4 icon">
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
  </section>

  <section>
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fa-solid fa-book-open-reader me-3 text-secondary"></i>Росмолодежь
          </h6>
          <p>
            Текст о нашем проекте...Текст о нашем проекте...Текст о нашем проекте...
          </p>

          <a href="{{ route('home') }}" class="mt-4 logo" >
              <img src="images/logo.png" alt="">
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
          <p>
            <a href="#!" class="text-reset">Дизайн</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Программирование</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Верстка</a>
          </p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Контакты</h6>
          <p><i class="fas fa-home me-3"></i>г.Курган, ул.Куйбышева, 36</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            info@example.com
          </p>
          <p><i class="fas fa-phone-alt me-3"></i> + 01 234 567 88</p>
        </div>
      </div>
    </div>
  </section>

  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
    © 2022 Copyright:
    <a class="text-reset fw-bold" href="">Росмолодежь</a>
  </div>
</footer>
