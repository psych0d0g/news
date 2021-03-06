<li ng-class="{
		active: feedBl.isActive(feed.id), 
		unread: feedBl.getUnreadCount(feed.id) > 0,
		failed: feed.error
	}" 
	ng-repeat="feed in feedBl.getFeedsOfFolder(<?php p($_['folderId']); ?>)"
	ng-show="feedBl.isVisible(feed.id) || !feed.id"
	data-id="{{ feed.id }}"
	class="feed"
	oc-draggable="{
		revert: true,
		stack: '> li',
		zIndex: 1000,
		axis: 'y',
		helper: 'clone'
	}">
	<a 	ng-style="{ backgroundImage: feed.faviconLink }"
		ng-click="feedBl.load(feed.id)"
		ng-class="{
			'progress-icon': !feed.id,
			'problem-icon': feed.error
		}"
	   	href="#"
	   	class="title">
	   	
	   {{ feed.title }}
	</a>
	
	<span class="utils">

		<span class="unread-counter" 
			ng-show="feed.id"
			ng-style="{opacity: getOpacity(feedBl.getUnreadCount(feed.id)) }">
			{{ feedBl.getUnreadCount(feed.id) }}
		</span>

		<button class="svg action mark-read-icon"
			ng-show="feedBl.getUnreadCount(feed.id) > 0 && feed.id"
			ng-click="feedBl.markFeedRead(feed.id)"
			title="<?php p($l->t('Mark all read')); ?>"> </button>
		
		<button ng-click="feedBl.delete(feed.id)"
			class="svg action delete-icon" 
			title="<?php p($l->t('Delete feed')); ?>"
			ng-show="feed.id"></button>

		<button class="svg action mark-read-icon"
			ng-click="feedBl.markErrorRead(feed.urlHash)"
			title="<?php p($l->t('Discard')); ?>"
			ng-show="feed.error"></button>
	</span>

	<div class="message" ng-show="feed.error">{{ feed.error }}</div>
</li>

