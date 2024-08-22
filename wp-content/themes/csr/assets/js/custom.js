(function() {
  

  /*Easy selector helper function*/
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /*Easy event listener function*/
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /* Easy on scroll event listener */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }
  /*Scrolls to an element with header offset */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

/*adding .header-scrolled class to #header when page is scrolled*/

  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 50) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }
  /*Mobile nav toggle*/
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
    const smallDevice = window.matchMedia("(min-width: 991.98px)");
    smallDevice.addListener(handleDeviceChange);
    function handleDeviceChange(e) {
      select('#navbar').classList.remove('navbar-mobile')
    }
  })

  /*Mobile nav dropdowns activate*/
  on('click', '.navbar .dropdown > a', function(e) {
     select('.bi-chevron-down').classList.toggle('bi-chevron-up')
     if (select('#navbar').classList.contains('navbar-mobile')) {
       e.preventDefault()
      select('.dropdown').classList.toggle('active')
      this.nextElementSibling.classList.toggle('dropdown-menu')
      }
   }, true) 

    /**
   * Back to top button
   */
 let backtotop = select('.back-to-top')
 if (backtotop) {
   const toggleBacktotop = () => {
     if (window.scrollY > 100) {
       backtotop.classList.add('active')
     } else {
       backtotop.classList.remove('active')
     }
   }
   window.addEventListener('load', toggleBacktotop)
   onscroll(document, toggleBacktotop)
 }


//stepper

const stepButtons = document.querySelectorAll('.step-button' && '.card-header');
const progress = document.querySelector('#progress');


Array.from(stepButtons).forEach((button,index) => {
    button.addEventListener('click', () => {
        progress.setAttribute('value', index * 100 /(stepButtons.length - 1) );
        stepButtons.forEach((item, secindex)=>{
       
            if(index > secindex){
                item.classList.add('done');		
            }
            if(index < secindex){
                item.classList.remove('done');			
            }
 	   
        })
    })
})

//Our Core Team starts

	$('.showBtn.core1').click(function () {

		if ($(this).hasClass('hideBtn')) {
			$('.member-info').slideUp();
			$(this).removeClass('hideBtn');
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core4').removeClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		} else {
			$('.member-info').slideUp();
			$('.showBtn').removeClass('hideBtn');
			$(this).addClass('hideBtn');
			$(this).next().filter('.member-info').slideDown();
			$('#core1').addClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core4').removeClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		}
	});
	$('.showBtn.core2').click(function () {

		if ($(this).hasClass('hideBtn')) {
			$('.member-info').slideUp();
			$(this).removeClass('hideBtn');
			$('#core4').removeClass('active');
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		} else {
			$('.member-info').slideUp();
			$('.showBtn').removeClass('hideBtn');
			$(this).addClass('hideBtn');
			$(this).next().filter('.member-info').slideDown();
			$('#core1').removeClass('active');
			$('#core3').removeClass('active');
			$('#core4').removeClass('active');
			$('#core2').addClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		}
	});
	$('.showBtn.core3').click(function () {

		if ($(this).hasClass('hideBtn')) {
			$('.member-info').slideUp();
			$(this).removeClass('hideBtn');
			$('#core3').removeClass('active');
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core4').removeClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		} else {
			$('.member-info').slideUp();
			$('.showBtn').removeClass('hideBtn');
			$(this).addClass('hideBtn');
			$(this).next().filter('.member-info').slideDown();
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core4').removeClass('active');
			$('#core3').addClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		}
	});
	$('.showBtn.core4').click(function () {

		if ($(this).hasClass('hideBtn')) {
			$('.member-info').slideUp();
			$(this).removeClass('hideBtn');
			$('#core4').removeClass('active');
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		} else {
			$('.member-info').slideUp();
			$('.showBtn').removeClass('hideBtn');
			$(this).addClass('hideBtn');
			$(this).next().filter('.member-info').slideDown();
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core4').addClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		}
	});
$('.showBtn.core5').click(function () {

		if ($(this).hasClass('hideBtn')) {
			$('.member-info').slideUp();
			$(this).removeClass('hideBtn');
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core4').removeClass('active');
			$('#core5').remoceClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		} else {
			$('.member-info').slideUp();
			$('.showBtn').removeClass('hideBtn');
			$(this).addClass('hideBtn');
			$(this).next().filter('.member-info').slideDown();
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core4').removeClass('active');
			$('#core5').addClass('active');			
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		}
	});
	$('.showBtn.core6').click(function () {

		if ($(this).hasClass('hideBtn')) {
			$('.member-info').slideUp();
			$(this).removeClass('hideBtn');
			$('#core3').removeClass('active');
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core4').removeClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		} else {
			$('.member-info').slideUp();
			$('.showBtn').removeClass('hideBtn');
			$(this).addClass('hideBtn');
			$(this).next().filter('.member-info').slideDown();
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core4').removeClass('active');
			$('#core5').removeClass('active');
			$('#core6').addClass('active');			
			$('#core3').removeClass('active');
			$('#core7').removeClass('active');

		}
	});
$('.showBtn.core7').click(function () {

		if ($(this).hasClass('hideBtn')) {
			$('.member-info').slideUp();
			$(this).removeClass('hideBtn');
			$('#core4').removeClass('active');
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');

		} else {
			$('.member-info').slideUp();
			$('.showBtn').removeClass('hideBtn');
			$(this).addClass('hideBtn');
			$(this).next().filter('.member-info').slideDown();
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core4').removeClass('active');
			$('#core6').removeClass('active');
			$('#core5').removeClass('active');
			$('#core7').addClass('active');

		}
	});
	
	$('.showBtn.core8').click(function () {

		if ($(this).hasClass('hideBtn')) {
			$('.member-info').slideUp();
			$(this).removeClass('hideBtn');
			$('#core4').removeClass('active');
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core5').removeClass('active');
			$('#core6').removeClass('active');
			$('#core7').removeClass('active');
			$('#core8').removeClass('active');

		} else {
			$('.member-info').slideUp();
			$('.showBtn').removeClass('hideBtn');
			$(this).addClass('hideBtn');
			$(this).next().filter('.member-info').slideDown();
			$('#core1').removeClass('active');
			$('#core2').removeClass('active');
			$('#core3').removeClass('active');
			$('#core4').removeClass('active');
			$('#core7').removeClass('active');
			$('#core6').removeClass('active');
			$('#core5').removeClass('active');
			$('#core8').addClass('active');

		}
	});


	//Our Core Team Ends
function removeOpen(index1) {
  accordionContent.forEach((item2, index2) => {
    if (index1 != index2) {
      item2.classList.remove('open');
      let descr = item2.querySelector('.description');
      descr.style.height = '0px';
      item2.querySelector('i').classList.replace('bx-minus', 'bx-plus');
    }
  });
}



// accordion 
// ---- ---- Const ---- ---- //
const accordionContent = document.querySelectorAll('.accordion-content');

// ---- ---- Class .open ---- ---- //

accordionContent.forEach((item, index) => {
  let header = item.querySelector('.header');
  header.addEventListener('click', () => {
    item.classList.toggle('open');

    // ---- ---- Height Description and Change Icon ---- ---- //
    let description = item.querySelector('.description');
    if (item.classList.contains('open')) {
      description.style.height = `${description.scrollHeight}px`;
      item.querySelector('i').classList.replace('bx-plus', 'bx-minus');
    } else {
      description.style.height = '0px';
      item.querySelector('i').classList.replace('bx-minus', 'bx-plus');
    }
    removeOpen(index);
  });
});


})()


/* images slider */

const sliderContainers = [...document.querySelectorAll('.slider-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

sliderContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})


/*******************************TimeSlider*********************************/


jQuery(document).ready(function($){
	var timelines = $('.cd-horizontal-timeline'),
		eventsMinDistance = 94;

	(timelines.length > 0) && initTimeline(timelines);

	function initTimeline(timelines) {
		timelines.each(function(){
			var timeline = $(this),
				timelineComponents = {};
			//cache timeline components 
			timelineComponents['timelineWrapper'] = timeline.find('.events-wrapper');
			timelineComponents['eventsWrapper'] = timelineComponents['timelineWrapper'].children('.events');
			timelineComponents['fillingLine'] = timelineComponents['eventsWrapper'].children('.filling-line');
			timelineComponents['timelineEvents'] = timelineComponents['eventsWrapper'].find('a');
			timelineComponents['timelineDates'] = parseDate(timelineComponents['timelineEvents']);
			timelineComponents['eventsMinLapse'] = minLapse(timelineComponents['timelineDates']);
			timelineComponents['timelineNavigation'] = timeline.find('.cd-timeline-navigation');
			timelineComponents['eventsContent'] = timeline.children('.events-content');

			//assign a left postion to the single events along the timeline
			setDatePosition(timelineComponents, eventsMinDistance);
			//assign a width to the timeline
			var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
			//the timeline has been initialize - show it
			timeline.addClass('loaded');

			//detect click on the next arrow
			timelineComponents['timelineNavigation'].on('click', '.next', function(event){
				event.preventDefault();
				updateSlide(timelineComponents, timelineTotWidth, 'next');
			});
			//detect click on the prev arrow
			timelineComponents['timelineNavigation'].on('click', '.prev', function(event){
				event.preventDefault();
				updateSlide(timelineComponents, timelineTotWidth, 'prev');
			});
			//detect click on the a single event - show new event content
			timelineComponents['eventsWrapper'].on('click', 'a', function(event){
				event.preventDefault();
				timelineComponents['timelineEvents'].removeClass('selected');
				$(this).addClass('selected');
				updateOlderEvents($(this));
				updateFilling($(this), timelineComponents['fillingLine'], timelineTotWidth);
				updateVisibleContent($(this), timelineComponents['eventsContent']);
			});

			//on swipe, show next/prev event content
			timelineComponents['eventsContent'].on('swipeleft', function(){
				var mq = checkMQ();
				( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'next');
			});
			timelineComponents['eventsContent'].on('swiperight', function(){
				var mq = checkMQ();
				( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'prev');
			});

			//keyboard navigation
			$(document).keyup(function(event){
				if(event.which=='37' && elementInViewport(timeline.get(0)) ) {
					showNewContent(timelineComponents, timelineTotWidth, 'prev');
				} else if( event.which=='39' && elementInViewport(timeline.get(0))) {
					showNewContent(timelineComponents, timelineTotWidth, 'next');
				}
			});
		});
	}

	function updateSlide(timelineComponents, timelineTotWidth, string) {
		//retrieve translateX value of timelineComponents['eventsWrapper']
		var translateValue = getTranslateValue(timelineComponents['eventsWrapper']),
			wrapperWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', ''));
		//translate the timeline to the left('next')/right('prev') 
		(string == 'next') 
			? translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth)
			: translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
	}

	function showNewContent(timelineComponents, timelineTotWidth, string) {
		//go from one event to the next/previous one
		var visibleContent =  timelineComponents['eventsContent'].find('.selected'),
			newContent = ( string == 'next' ) ? visibleContent.next() : visibleContent.prev();

		if ( newContent.length > 0 ) { //if there's a next/prev event - show it
			var selectedDate = timelineComponents['eventsWrapper'].find('.selected'),
				newEvent = ( string == 'next' ) ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');
			
			updateFilling(newEvent, timelineComponents['fillingLine'], timelineTotWidth);
			updateVisibleContent(newEvent, timelineComponents['eventsContent']);
			newEvent.addClass('selected');
			selectedDate.removeClass('selected');
			updateOlderEvents(newEvent);
			updateTimelinePosition(string, newEvent, timelineComponents, timelineTotWidth);
		}
	}

	function updateTimelinePosition(string, event, timelineComponents, timelineTotWidth) {
		//translate timeline to the left/right according to the position of the selected event
		var eventStyle = window.getComputedStyle(event.get(0), null),
			eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
			timelineWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', '')),
			timelineTotWidth = Number(timelineComponents['eventsWrapper'].css('width').replace('px', ''));
		var timelineTranslate = getTranslateValue(timelineComponents['eventsWrapper']);

        if( (string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < - timelineTranslate) ) {
        	translateTimeline(timelineComponents, - eventLeft + timelineWidth/2, timelineWidth - timelineTotWidth);
        }
	}

	function translateTimeline(timelineComponents, value, totWidth) {
		var eventsWrapper = timelineComponents['eventsWrapper'].get(0);
		value = (value > 0) ? 0 : value; //only negative translate value
		value = ( !(typeof totWidth === 'undefined') &&  value < totWidth ) ? totWidth : value; //do not translate more than timeline width
		setTransformValue(eventsWrapper, 'translateX', value+'px');
		//update navigation arrows visibility
		(value == 0 ) ? timelineComponents['timelineNavigation'].find('.prev').addClass('inactive') : timelineComponents['timelineNavigation'].find('.prev').removeClass('inactive');
		(value == totWidth ) ? timelineComponents['timelineNavigation'].find('.next').addClass('inactive') : timelineComponents['timelineNavigation'].find('.next').removeClass('inactive');
	}

	function updateFilling(selectedEvent, filling, totWidth) {
		//change .filling-line length according to the selected event
		var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
			eventLeft = eventStyle.getPropertyValue("left"),
			eventWidth = eventStyle.getPropertyValue("width");
		eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', ''))/2;
		var scaleValue = eventLeft/totWidth;
		setTransformValue(filling.get(0), 'scaleX', scaleValue);
	}

	function setDatePosition(timelineComponents, min) {
		for (i = 0; i < timelineComponents['timelineDates'].length; i++) { 
		    var distance = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][i]),
		    	distanceNorm = Math.round(distance/timelineComponents['eventsMinLapse']) + 2;
		    timelineComponents['timelineEvents'].eq(i).css('left', distanceNorm*min+'px');
		}
	}

	function setTimelineWidth(timelineComponents, width) {
		var timeSpan = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][timelineComponents['timelineDates'].length-1]),
			timeSpanNorm = timeSpan/timelineComponents['eventsMinLapse'],
			timeSpanNorm = Math.round(timeSpanNorm) + 4,
			totalWidth = timeSpanNorm*width;
		timelineComponents['eventsWrapper'].css('width', totalWidth+'px');
		updateFilling(timelineComponents['timelineEvents'].eq(0), timelineComponents['fillingLine'], totalWidth);
	
		return totalWidth;
	}

	function updateVisibleContent(event, eventsContent) {
		var eventDate = event.data('date'),
			visibleContent = eventsContent.find('.selected'),
			selectedContent = eventsContent.find('[data-date="'+ eventDate +'"]'),
			selectedContentHeight = selectedContent.height();

		if (selectedContent.index() > visibleContent.index()) {
			var classEnetering = 'selected enter-right',
				classLeaving = 'leave-left';
		} else {
			var classEnetering = 'selected enter-left',
				classLeaving = 'leave-right';
		}

		selectedContent.attr('class', classEnetering);
		visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
			visibleContent.removeClass('leave-right leave-left');
			selectedContent.removeClass('enter-left enter-right');
		});
		eventsContent.css('height', selectedContentHeight+'px');
	}

	function updateOlderEvents(event) {
		event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
	}

	function getTranslateValue(timeline) {
		var timelineStyle = window.getComputedStyle(timeline.get(0), null),
			timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
         		timelineStyle.getPropertyValue("-moz-transform") ||
         		timelineStyle.getPropertyValue("-ms-transform") ||
         		timelineStyle.getPropertyValue("-o-transform") ||
         		timelineStyle.getPropertyValue("transform");

        if( timelineTranslate.indexOf('(') >=0 ) {
        	var timelineTranslate = timelineTranslate.split('(')[1];
    		timelineTranslate = timelineTranslate.split(')')[0];
    		timelineTranslate = timelineTranslate.split(',');
    		var translateValue = timelineTranslate[4];
        } else {
        	var translateValue = 0;
        }

        return Number(translateValue);
	}

	function setTransformValue(element, property, value) {
		element.style["-webkit-transform"] = property+"("+value+")";
		element.style["-moz-transform"] = property+"("+value+")";
		element.style["-ms-transform"] = property+"("+value+")";
		element.style["-o-transform"] = property+"("+value+")";
		element.style["transform"] = property+"("+value+")";
	}

		function parseDate(events) {
		var dateArrays = [];
		events.each(function(){
			var dateComp = $(this).data('date').split('/'),
				newDate = new Date(dateComp[2], dateComp[1]-1, dateComp[0]);
			dateArrays.push(newDate);
		});
	    return dateArrays;
	}

	function parseDate2(events) {
		var dateArrays = [];
		events.each(function(){
			var singleDate = $(this),
				dateComp = singleDate.data('date').split('T');
			if( dateComp.length > 1 ) { //both DD/MM/YEAR and time are provided
				var dayComp = dateComp[0].split('/'),
					timeComp = dateComp[1].split(':');
			} else if( dateComp[0].indexOf(':') >=0 ) { //only time is provide
				var dayComp = ["2000", "0", "0"],
					timeComp = dateComp[0].split(':');
			} else { //only DD/MM/YEAR
				var dayComp = dateComp[0].split('/'),
					timeComp = ["0", "0"];
			}
			var	newDate = new Date(dayComp[2], dayComp[1]-1, dayComp[0], timeComp[0], timeComp[1]);
			dateArrays.push(newDate);
		});
	    return dateArrays;
	}

	function daydiff(first, second) {
	    return Math.round((second-first));
	}

	function minLapse(dates) {
		//determine the minimum distance among events
		var dateDistances = [];
		for (i = 1; i < dates.length; i++) { 
		    var distance = daydiff(dates[i-1], dates[i]);
		    dateDistances.push(distance);
		}
		return Math.min.apply(null, dateDistances);
	}

		function elementInViewport(el) {
		var top = el.offsetTop;
		var left = el.offsetLeft;
		var width = el.offsetWidth;
		var height = el.offsetHeight;

		while(el.offsetParent) {
		    el = el.offsetParent;
		    top += el.offsetTop;
		    left += el.offsetLeft;
		}

		return (
		    top < (window.pageYOffset + window.innerHeight) &&
		    left < (window.pageXOffset + window.innerWidth) &&
		    (top + height) > window.pageYOffset &&
		    (left + width) > window.pageXOffset
		);
	}

	function checkMQ() {
		//check if mobile or desktop device
		return window.getComputedStyle(document.querySelector('.cd-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
	}
});

// owl carousel for testimonials and join us section - images 

$(document).ready(function() {
  $('.testimonial-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    nav:false,
    autoplay:true,
    auroplayTimeout:1000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:1,
        },
        1000:{
          items: 2,
        }
    }
  });

  $('.images-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    nav:false,
    autoplay:true,
    auroplayTimeout:1000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:2,
        },
        1000:{
          items: 3,
        }
    }
  });
  
})

