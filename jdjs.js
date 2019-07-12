function() {
  var label = $(this).find('.label');
  var nav = $('.nav-main');
  var items = nav.find('.menu-item');
  if (nav.hasClass('is-opened')) {
    var labelText = label.attr('data-label-closed');
    if (isDesktop) {
      var tl = new TimelineLite();
      tl.pause();
      tl.set(items, {
        display: 'inline-block'
      });
      tl.call(function() {
        nav.removeClass('is-opened');
      });
      tl.staggerTo(items, 0.3, {
        rotationX: -90,
        x: -10,
        ease: Power2.easeIn
      }, 0.08);
      tl.call(function() {
        items.attr('style', '');
        label.text(labelText);
      });
      tl.play();
    } else {
      items.reverse();
      var tl = new TimelineLite();
      tl.pause();
      tl.set(items, {
        display: 'block',
        transform: 'perspective(200px)',
        transformOrigin: '50% -5px 0'
      });
      tl.call(function() {
        nav.removeClass('is-opened');
      });
      tl.staggerTo(items, 0.3, {
        rotationX: -90,
        ease: Power3.easeIn
      }, 0.1);
      tl.call(function() {
        items.attr('style', '');
        label.text(labelText);
      });
      tl.play();
    }
    var tl2 = new TimelineLite();
    tl2.pause();
    tl2.to(label, 0.3, {
      x: 20,
      alpha: 0,
      ease: Power3.easeIn
    });
    tl2.call(function() {
      label.text(label.attr('data-label-closed'));
    });
    tl2.to(label, 0.3, {
      x: 0,
      alpha: 1,
      ease: Power3.easeOut
    });
    tl2.call(function() {
      label.attr('style', '');
    });
    tl2.play();
  } else {
    if (isDesktop) {
      items.reverse();
      var tl = new TimelineLite();
      tl.pause();
      tl.set(items, {
        display: 'inline-block',
        rotationX: -90,
        x: 10
      });
      tl.call(function() {
        nav.addClass('is-opened');
      });
      tl.staggerTo(items, 0.3, {
        rotationX: 0,
        x: 0,
        ease: Power2.easeOut
      }, 0.08);
      tl.call(function() {
        items.attr('style', '');
      });
      tl.play();
    } else {
      var tl = new TimelineLite();
      tl.pause();
      tl.set(items, {
        display: 'block',
        transform: 'perspective(200px) rotateX(-90deg)',
        transformOrigin: '50% -5px 0'
      });
      tl.call(function() {
        nav.addClass('is-opened');
      });
      tl.staggerTo(items, 0.3, {
        rotationX: 0,
        ease: Power3.easeOut
      }, 0.1);
      tl.call(function() {
        items.attr('style', '');
      });
      tl.play();
    }
    var tl2 = new TimelineLite();
    tl2.pause();
    tl2.to(label, 0.3, {
      x: 20,
      alpha: 0,
      ease: Power3.easeIn
    });
    tl2.call(function() {
      label.text(label.attr('data-label-opened'));
    });
    tl2.to(label, 0.3, {
      x: 0,
      alpha: 1,
      ease: Power3.easeOut
    });
    tl2.call(function() {
      label.attr('style', '');
    });
    tl2.play();
  }
}


horizontal <767px
box 767<x<1024
slim <1024

 <div>
                    <div class="text-left options" style="float:left"><a href="<?php echo $router->generate('search').'?p=planner'; ?>">PLANNERS</a></div>
                    <div class="text-right options" style="float:right"><a href="<?php echo $router->generate('search').'?p=event'; ?>">EVENTS</a></div>
                  </div>