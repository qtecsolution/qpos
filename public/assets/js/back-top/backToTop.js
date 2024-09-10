'use strict';

// ===============================================
// up button
// ===============================================
 function up(set) {
  const upBtn = document.createElement('button');
  let upBtnImg;

  upBtn.classList.add('up-btn', 'up-btn__hide');

  function showBtn(num) {
    if (document.documentElement.scrollTop >= num) {
      upBtn.classList.remove('up-btn__hide');
    } else {
      upBtn.classList.add('up-btn__hide');
    }
  }

  if (set) {

    if (set.src) {
      upBtnImg = document.createElement('img');
      upBtnImg.src = set.src;
      upBtnImg.classList.add('up-btn__img');
    } else {
      upBtnImg = document.createElement('div');
      upBtnImg.innerHTML = `
        <svg viewBox="0 0 448 512"><path fill="#fff" d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z"></path></svg>
      `;
      upBtnImg.classList.add('up-btn__img');
    }

    upBtn.style.top = set.top;
    upBtn.style.bottom = set.bottom;
    upBtn.style.left = set.left;
    upBtn.style.right = set.right;
    upBtn.style.background = set.bg;
    upBtn.style.width = set.width;
    upBtn.style.height = set.height;

    if (set.circle) {
      upBtn.classList.add('up-btn_circle');
    }

    document.body.append(upBtn);
    upBtn.append(upBtnImg);


    if (set.whenShow) {
      window.addEventListener('scroll', () => {
        showBtn(set.whenShow);
      });
    } else {
      window.addEventListener('scroll', () => {
        showBtn(400);
      });
    }

  } else {
    upBtnImg = document.createElement('div');
      upBtnImg.innerHTML = `
        <svg viewBox="0 0 448 512"><path fill="#fff" d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z"></path></svg>
      `;
      upBtnImg.classList.add('up-btn__img');
    document.body.append(upBtn);
    upBtn.append(upBtnImg);

    window.addEventListener('scroll', () => {
      showBtn(400);
    });
  }

  upBtn.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });

}
