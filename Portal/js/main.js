jQuery(document).ready(function($){
	//store DOM elements
	var imageWrapper = $('.sr-images-list'),
		imagesList = imageWrapper.children('li'),
		contentWrapper = $('.sr-content-block'),
		contentList = contentWrapper.children('ul').eq(0).children('li'),
		blockNavigation = $('.block-navigation'),
		blockNavigationNext = blockNavigation.find('.sr-next'),
		blockNavigationPrev = blockNavigation.find('.sr-prev'),
		//used to check if the animation is running
		animating = false;

	//on mobile - open a single project content when selecting a project image
	imageWrapper.on('click', 'a', function(event){
		event.preventDefault();
		var device = MQ();
		
		(device == 'mobile') && updateBlock(imagesList.index($(this).parent('li')), 'mobile');
	});

	//on mobile - close visible project when clicking the .sr-close btn
	contentWrapper.on('click', '.sr-close', function(){
		var closeBtn = $(this);
		if( !animating ) {
			animating = true;
			
			closeBtn.removeClass('is-scaled-up').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				contentWrapper.removeClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
					animating = false;
				});

				$('.sr-image-block').removeClass('content-block-is-visible');
				closeBtn.off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
			});
		}
	});

	//on desktop - update visible project when clicking the .block-navigation
	blockNavigation.on('click', 'button', function(){
		var direction = $(this),
			indexVisibleblock = imagesList.index(imageWrapper.children('li.is-selected'));

		if( !direction.hasClass('inactive') ) {
			var index = ( direction.hasClass('sr-next') ) ? (indexVisibleblock + 1) : (indexVisibleblock - 1); 
			updateBlock(index);
		}
	});

	//on desktop - update visible project on keydown
	$(document).on('keydown', function(event){
		var device = MQ();
		if( event.which=='39' && !blockNavigationNext.hasClass('inactive') && device == 'desktop') {
			//go to next project
			updateBlock(imagesList.index(imageWrapper.children('li.is-selected')) + 1);
		} else if( event.which=='37' && !blockNavigationPrev.hasClass('inactive') && device == 'desktop' ) {
			//go to previous project
			updateBlock(imagesList.index(imageWrapper.children('li.is-selected')) - 1);
		}
	});

	function updateBlock(n, device) {
		if( !animating) {
			animating = true;
			var imageItem = imagesList.eq(n),
				contentItem = contentList.eq(n);
			
			classUpdate($([imageItem, contentItem]));
			
			if( device == 'mobile') {
				contentItem.scrollTop(0);
				$('.sr-image-block').addClass('content-block-is-visible');
				contentWrapper.addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
					contentWrapper.find('.sr-close').addClass('is-scaled-up');
					animating = false;
				});
			} else {
				contentList.addClass('overflow-hidden');
				contentItem.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
					contentItem.siblings().scrollTop(0);
					contentList.removeClass('overflow-hidden');
					animating = false;
				});
			}

			//if browser doesn't support transition
			if( $('.no-csstransitions').length > 0 ) animating = false;

			updateBlockNavigation(n);
		}
	}

	function classUpdate(items) {
		items.each(function(){
			var item = $(this);
			item.addClass('is-selected').removeClass('move-left').siblings().removeClass('is-selected').end().prevAll().addClass('move-left').end().nextAll().removeClass('move-left');
		});
	}

	function updateBlockNavigation(n) {
		( n == 0 ) ? blockNavigationPrev.addClass('inactive') : blockNavigationPrev.removeClass('inactive');
		( n + 1 >= imagesList.length ) ? blockNavigationNext.addClass('inactive') : blockNavigationNext.removeClass('inactive');
	}

	function MQ() {
		return window.getComputedStyle(imageWrapper.get(0), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "").split(', ');
	}

});