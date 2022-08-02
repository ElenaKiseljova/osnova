(() => {
  'use strict';

  // Кнопка "Подробнее" в Каталоге
  const deviceWidth = window.innerWidth && document.documentElement.clientWidth ?
    Math.min(window.innerWidth, document.documentElement.clientWidth) :
    window.innerWidth ||
    document.documentElement.clientWidth ||
    document.getElementsByTagName('body')[0].clientWidth;

  let HEIGHT_TEXT_DEFAULT = 140;

  if (deviceWidth > 499 && deviceWidth < 1025) {
    HEIGHT_TEXT_DEFAULT = 84;
  } else if (deviceWidth > 1024) {
    HEIGHT_TEXT_DEFAULT = 63;
  }

  const readMoreButton = document.querySelector('.category__read-more');
  const readMoreText = document.querySelector('.category__text');

  if (readMoreButton && readMoreText) {
    const readMoreTextHeight = readMoreText.offsetHeight;

    if (readMoreTextHeight > HEIGHT_TEXT_DEFAULT) {
      readMoreText.style.height = HEIGHT_TEXT_DEFAULT + 'px';

      readMoreText.classList.add('changed');

      readMoreButton.addEventListener('click', () => {
        if (readMoreButton.classList.contains('open')) {
          readMoreText.style.height = HEIGHT_TEXT_DEFAULT + 'px';

          readMoreButton.classList.remove('open');
          readMoreButton.classList.add('close');

          readMoreButton.textContent = readMoreButton.dataset.stateClose || 'Read more';
        } else {
          readMoreText.style.height = readMoreTextHeight + 'px';

          readMoreButton.classList.remove('close');
          readMoreButton.classList.add('open');

          readMoreButton.textContent = readMoreButton.dataset.stateOpen || 'Read less';
        }
      });
    } else {
      readMoreButton.remove();
    }
  }

  // Плавный скролл к элементам
  const scrollSmooth = (container = document) => {
    try {
      const hrefAttributes = container.querySelectorAll("a[href*='#']");

      hrefAttributes.forEach((item) => {
        const href = item.href.split('#');

        const CURRENT_URL = window.location.origin + window.location.pathname;

        if (href[0] === CURRENT_URL) {
          item?.addEventListener('click', (e) => {
            e.preventDefault();

            const scrollTarget = document.getElementById(href[1]);

            if (scrollTarget) {
              const topOffset = 0;
              const elementPosition = scrollTarget.getBoundingClientRect().top;
              const offsetPosition = elementPosition - topOffset;

              window.scrollBy({
                top: offsetPosition,
                behavior: 'smooth',
              });
            }
          });
        }
      });
    } catch (error) {
      console.log(error);
    }
  };

  // Ф-я удаления активного класса у массива элементов
  const removeActiveClass = (elements, className = 'active') => {
    elements.forEach((element, i) => {
      if (element.classList.contains(className)) {
        element.classList.remove(className);
      }
    });
  };

  const additional = {
    // Кнопка "Больше"
    moreButton() {
      try {
        const moreButton = document.querySelector('#more-button');
        const moreList = document.querySelector('#more-list');

        if (moreButton && moreList) {
          const postType = moreButton.dataset.postType;
          let currentPage = window.paged ? parseInt(window.paged, 10) : 1;
          const maxNumPages = moreButton.dataset.maxNumPages ? parseInt(moreButton.dataset.maxNumPages, 10) : 1;

          if (postType) {
            const callback = () => {
              if (maxNumPages === currentPage) {
                moreButton.remove();
              }
            };

            moreButton.addEventListener('click', () => {
              additional.getAjaxMore(++currentPage, moreList, postType, callback);
            });
          }
        }
      } catch (e) {
        console.log(e);
      }
    },
    // Пагинация
    paginationActivate() {
      try {
        const paginationButtons = document.querySelectorAll('.pagination__button');

        let paginationPrev, paginationNext;

        paginationButtons.forEach((paginationButton) => {
          if (paginationButton.classList.contains('pagination__button--prev')) {
            paginationPrev = paginationButton;
          }

          if (paginationButton.classList.contains('pagination__button--next')) {
            paginationNext = paginationButton;
          }

          paginationButton.addEventListener('click', (e) => {
            if (paginationButton.classList.contains('pagination__button--page') && !paginationButton.classList.contains('current')) {
              removeActiveClass(paginationButtons, 'current');

              if (paginationPrev && paginationButton.classList.contains('first')) {
                paginationPrev.classList.add('disabled');
              } else if (paginationPrev && !paginationButton.classList.contains('first')) {
                paginationPrev.classList.remove('disabled');
              }

              if (paginationNext && paginationButton.classList.contains('last')) {
                paginationNext.classList.add('disabled');
              } else if (paginationNext && !paginationButton.classList.contains('last')) {
                paginationNext.classList.remove('disabled');
              }

              paginationButton.classList.add('current');


            } else if (paginationButton.classList.contains('pagination__button--prev') || paginationButton.classList.contains('pagination__button--next')) {
              const toPaged = paginationButton.dataset.paged;
              const toPagedButton = [].find.call(paginationButtons, (button) => button.classList.contains('pagination__button--page') && button.dataset.paged === toPaged);

              if (toPagedButton) {
                removeActiveClass(paginationButtons, 'current');

                toPagedButton.classList.add('current');
              }
            }

            additional.getPage(paginationButton);
          });
        });
      } catch (e) {
        console.log(e);
      }
    },
    // Получение номера страницы
    getPage(button) {
      let paged = button.dataset.paged;

      paged = paged ? paged : 1;

      window.paged = paged;

      additional.getAjaxPage(paged);
    },
    // Запрос на получение Товаров с определенной страницы
    getAjaxPage(paged) {
      const dataAjaxContainer = document.querySelector('#catalog-ajax');

      if (dataAjaxContainer) {
        let dataForm = new FormData();

        dataForm.append('action', 'osnova_ajax_get_posts_list_html');
        dataForm.append('security', osnova_ajax.nonce);

        dataForm.append('posts_per_page', window.postPerpage);
        dataForm.append('paged', paged);
        dataForm.append('taxonomy', window.taxonomy);
        dataForm.append('term_id', window.term_id);
        dataForm.append('order', window.order);

        additional.onAjax(dataForm, dataAjaxContainer);
      }
    },
    // Запрос на получение Товаров со следующей страницы и добавление ко списку
    getAjaxMore(paged, dataAjaxContainer, postType, callback) {
      let dataForm = new FormData();

      dataForm.append('action', 'osnova_ajax_get_posts_list_html');

      dataForm.append('post_type', postType);

      dataForm.append('security', osnova_ajax.nonce);

      dataForm.append('posts_per_page', window.postPerpage);
      dataForm.append('paged', paged);
      dataForm.append('taxonomy', window.taxonomy);
      dataForm.append('term_id', window.term_id);
      dataForm.append('order', window.order);

      dataForm.append('replace', 0);

      additional.onAjax(dataForm, dataAjaxContainer, callback, false);
    },
    // Отправка на сервер данных для получения списка Видео
    onAjax(dataForm, dataAjaxContainer, сallback, replace = true) {
      try {
        const url = osnova_ajax.url;

        dataAjaxContainer.classList.add('sending');

        fetch(url, {
          method: 'POST',
          credentials: 'same-origin',
          body: dataForm
        })
          .then((response) => response.json())
          .then((response) => {
            if (response.success === true) {
              console.log(replace);
              if (replace) {
                dataAjaxContainer.innerHTML = response.data.content;

                // Переинициализация ф-й для ноыого контента
                if (!сallback) {
                  additional.paginationActivate();

                  additional.moreButton();

                  scrollSmooth(dataAjaxContainer);
                } else if (typeof сallback === 'function') {
                  сallback();
                }
              } else {
                dataAjaxContainer.innerHTML += response.data.content;

                if (typeof сallback === 'function') {
                  сallback();
                }
              }

              console.log('Успех:', response);
            } else {
              console.error('Ошибка:', response);
            }

            dataAjaxContainer.classList.remove('sending');
          })
          .catch((error) => {
            console.error('Ошибка:', error);

            dataAjaxContainer.classList.remove('sending');
          });
      } catch (error) {
        console.error('Ошибка:', error);

        dataAjaxContainer.classList.remove('sending');
      }
    },
  };

  document.addEventListener('DOMContentLoaded', () => {
    scrollSmooth();

    additional.paginationActivate();

    additional.moreButton();

    const forms = document.querySelectorAll('form');

    if (forms.length > 0) {
      forms.forEach((form) => {
        const productNameField = form.querySelector('#product-name');
        const productLinkField = form.querySelector('#product-link');

        const tel = form.querySelector('.tel');
        const itiSelectedDialCode = form.querySelector('.iti__selected-dial-code');
        const fullTel = form.querySelector('.full-tel');

        if (tel && itiSelectedDialCode && fullTel) {
          tel.addEventListener('input', (evt) => {
            fullTel.value = itiSelectedDialCode.textContent + ' ' + tel.value;
          });
        }

        // Чекбокс в форме
        const termsInput = form.querySelector('#terms');

        if (termsInput) {
          termsInput.addEventListener('change', () => {
            const termsInputLabel = termsInput.closest('label');

            if (termsInputLabel) {
              if (termsInput.checked) {
                termsInputLabel.classList.add('checked');
              } else {
                termsInputLabel.classList.remove('checked');
              }
            }
          });
        }

        // Обработчик успешной отправки формы
        form.addEventListener('wpcf7mailsent', (evt) => {
          if (termsInput) {
            const termsInputLabel = termsInput.closest('label');

            if (termsInputLabel) {
              termsInputLabel.classList.remove('checked');
            }
          }

          if (fullTel && fullTel.value) {
            fullTel.value = '';
          }
        });

        form.addEventListener('submit', (evt) => {
          evt.preventDefault();

          if (window.productName && window.productLink && productNameField && productLinkField) {
            productNameField.value = window.productName.trim();
            productLinkField.value = window.productLink.trim();
          }
        });
      });
    }

    const gtranslate_wrapper = document.querySelector('#gtranslate_wrapper');
    const linkLangs = document.querySelectorAll('.lang__link');

    if (gtranslate_wrapper && linkLangs.length > 0) {
      linkLangs.forEach((linkLang) => {
        linkLang.addEventListener('click', (evt) => {
          evt.preventDefault();

          let curLangCode = linkLang.dataset.text.toLowerCase().trim();

          curLangCode = (curLang === 'ua') ? 'uk' : curLangCode;

          doGTranslate(`ru|${curLangCode}`);

          window.location.href = linkLang.href;
        });
      });

      let curLang = document.querySelector('.lang__link--active').dataset.text.toLowerCase().trim();

      curLang = (curLang === 'ua') ? 'uk' : curLang;

      doGTranslate(`ru|${curLang}`);

      // console.log(GTranslateGetCurrentLang(), curLang);
    }
  });
})();