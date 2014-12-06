<div>
	<?php foreach ($posts as $post): ?>
	<div class="row">
		<div class="small-9 large-7 columns"><p><?php echo h($post[ 'Post'][ 'question']); ?>&nbsp;</p></div>
		<div <?php echo 'class="score small-1 large-1 columns'; $score=h(intval($post[ 'Post'][ 'nbLike'])-intval($post[ 'Post'][ 'nbDislike']));if($score>=0){echo ' green';} else{echo ' red';}; ?>"><?php echo $score; ?></div>
		<div class="small-2 large-4 columns">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array(), __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
		</div>
		<hr>
	</div>
	<?php endforeach; ?>

</div>