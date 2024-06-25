"use strict";

var croppie;
$('#avatar').on('change', function () {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#croppie img').attr('src', e.target.result);
      croppie = new Croppie($('#croppie img')[0], {
        boundary: {
          width: 250,
          height: 250,
          type: 'circle'
        },
        viewport: {
          width: 120,
          height: 120,
          type: 'circle'
        }
      });
    };

    $.fancybox.open({
      src: '#ava-modal',
      clickSlide: false,
      touch: false,
      closeBtn: false,
      smallBtn: false,
      buttons: [],
      mobile: {
        // clickContent : "close",
        clickSlide: false
      }
    });
    $('#upload').on('click', function () {
      croppie.result({
        type: 'base64',
        circle: false
      }).then(function (dataImg) {
        var data = [{
          image: dataImg
        }, {
          name: 'myimgage.jpg'
        }]; // use ajax to send data to php

        $('#result_image img').attr('src', dataImg).addClass('show');
        $('.personal-ava').addClass('show');
      });
      $.fancybox.close();
      croppie.destroy();
    });
    $('.close_upload').on('click', function () {
      $.fancybox.close();
      croppie.destroy();
    });
    reader.readAsDataURL(this.files[0]);
  }
});
$(document).ready(function () {
  $(".search-input").focus(function () {
    $(this).addClass('active focus');
  }).blur(function () {
    if ($(this).val() == "") {
      $(this).removeClass('active');
    }

    $(this).removeClass('focus');
  });
  $('.ava-change').click(function (e) {
    e.preventDefault();
    $('#avatar').trigger('click');
  });
  $('.tog-nav').on('click', function () {
    $('body').toggleClass('open_nav');
  });
});
$(window).on('load resize scroll', function () {
  var bw = window.innerWidth;
  var bh = window.innerHeight;
  $('.enter-group__text').css('min-height', bh);
  var as_t = $('.aside-top').outerHeight();
  $('.aside-nav').css('max-height', bh - as_t);
});