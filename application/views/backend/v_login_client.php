<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="icon" href="<?= favicon_url() ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="./assets/img/apple-icon.png"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css"
    />
    <title>Bride Login Younme Organizer</title>
  </head>
  <body class="text-gray-800 antialiased">
    <main>
      <section class="absolute w-full h-full">
        <div
          class="absolute top-0 w-full h-full bg-white bg-cover bg-center"
          style="background-image: url('<?= htmlspecialchars(bg_login_url('assets/backend/src/images/logo/bgclogin.png'), ENT_QUOTES) ?>'); background-size: cover; background-repeat: no-repeat;"
        ></div>
        <div class="container mx-auto px-4 h-full">
          <div class="flex content-center items-center justify-center h-full">
            <div class="w-full lg:w-4/12 px-4">
              <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-transparent border-0"
                style="background-color: rgba(255, 255, 255, 0.8);"
              >
                <div class="rounded-t mb-0 px-6 py-6">
                    <img src="<?= logo_login_url() ?>" alt="Logo" style="width: 300px; margin: 0 auto;">
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                  <form action="<?= base_url('client/login') ?>" method="post">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <?php echo $this->session->flashdata('login_failed'); ?>
                    <?php echo $this->session->flashdata('msg'); ?>
                    <?php
                      if ($this->input->post('email')!=''){
                        echo "<div class='alert bg-5'><center>$title</center></div>";
                      }elseif($this->input->post('username')!=''){
                        echo "<div class='alert bg-5'><center>$title</center></div>";
                      }
                      echo form_open('client/login');
                    ?>
                    <div class="mb-4">
                      <div class="relative">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                      </svg>
                      <input type="text" name="username" onkeyup="this.value = this.value.toLowerCase()" value="<?php echo set_value('username') ?>" placeholder="Username" class="w-full pl-12 rounded-lg border border-gray-400 bg-transparent py-2 px-4 outline-none focus:border-gray-600 dark:border-gray-600 dark:bg-form-input dark:focus:border-gray-400" />
                      </div>
                      <span class="text-sm text-gray-600"><?php echo form_error('username'); ?></span>
                    </div>
                    <div class="mb-4">
                      <div class="relative">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                      </svg>
                      <input type="password" name="password" placeholder="Password" class="w-full pl-12 pr-12 rounded-lg border border-gray-400 bg-transparent py-2 px-4 outline-none focus:border-gray-600 dark:border-gray-600 dark:bg-form-input dark:focus:border-gray-400" />
                      <button type="button" onclick="toggleLoginPassword(this)" tabindex="-1" aria-label="Tampilkan password" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="eye-open w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="eye-closed hidden w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                      </button>
                      </div>
                      <span class="text-sm text-gray-600"><?php echo form_error('password'); ?></span>
                    </div>
                    <div class="mb-1">
                      <input type="submit" name="submit" value="Sign In" class="w-full cursor-pointer rounded-lg bg-[#ed126b] text-white py-2 px-4 font-medium hover:bg-opacity-90" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="absolute w-full bottom-0 bg-white pb-6">
          <div class="container mx-auto px-4">
            <hr class="mb-6 border-b-1 border-gray-700" />
            <div class="flex flex-wrap items-center md:justify-between justify-center">
              <div class="w-full md:w-4/12 px-4">
                <div class="text-sm text-gray-900 font-semibold py-1">
                  <?= teks_footer_beranda() ?>
                </div>
              </div>
            </div>
          </div>
        </footer>
      </section>
    </main>
  </body>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const usernameInput = document.querySelector('input[name="username"]');
      const passwordInput = document.querySelector('input[name="password"]');

      const changeTextColor = (input) => {
        input.style.color = '#ed126b';
      };

      usernameInput.addEventListener('input', () => changeTextColor(usernameInput));
      passwordInput.addEventListener('input', () => changeTextColor(passwordInput));
    });

      function toggleLoginPassword(btn) {
      const input = btn.parentElement.querySelector('input[name="password"]');
      const eyeOpen = btn.querySelector('.eye-open');
      const eyeClosed = btn.querySelector('.eye-closed');
      const showing = input.type === 'text';
      input.type = showing ? 'password' : 'text';
      eyeOpen.classList.toggle('hidden', !showing);
      eyeClosed.classList.toggle('hidden', showing);
    }

  
  </script>
</html>