<div class="panel row radius">
  <h5>Posez vos questions aux intervenants !</h5>
  <p>Vous pouvez voir ici les questions des autres auditeurs de la conférence. Cliquez sur "Poser une question" pour interpeller les conférenciers.
  N'hésitez pas à donner votre avis sur la pertinence des questions ! </p>
</div>
<div class="row">
<div class="large-12 columns">
<form action="/posts" id="PostIndexForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>	<div class="input textarea"><textarea name="data[Post][question]" cols="30" rows="6" id="PostQuestion"></textarea></div><div class="submit"><input class="button" type="submit" value="Submit"/></div></form></div>
</div>
</div>	
<div>
	<?php foreach ($posts as $post): ?>
	<div class="row">
		<div class="small-9 large-7 columns"><p><?php echo h($post[ 'Post'][ 'question']); ?>&nbsp;</p></div>
		<div <?php echo 'class="score small-3 large-1 columns'; $score=h(intval($post[ 'Post'][ 'nbLike'])-intval($post[ 'Post'][ 'nbDislike']));if($score>=0){echo ' green';} else{echo ' red';}; ?>"><?php echo $score; ?></div>
		<div class="small-12 large-4 columns">
			<a <?php echo 'href="posts/like/';echo $post['Post']['id']; echo'">'; ?><div <?php echo 'class="small-3 large-6 columns column-vote column-vote-up';if($this->Session->read('Person')){if(in_array($post['Post']['id'],$this->Session->read('Person.liked'))){echo " hide";}};echo '">' ?><img src="/img/like.png" /></div></a>
			<a <?php echo 'href="posts/disLike/';echo $post['Post']['id']; echo'">'; ?><div <?php echo 'class="small-3 large-6 columns column-vote column-vote-down';if($this->Session->read('Person')){if(in_array($post['Post']['id'],$this->Session->read('Person.liked'))){echo " hide";}};echo '">' ?><img src="/img/dislike.png" /></div></a>
		<!--	<div <?php echo 'class="small-4 large-6 columns column-vote column-vote-down';if($this->Session->read('Person')){if(in_array($post['Post']['id'],$this->Session->read('Person.liked'))){echo " hide";}};echo '">' ?><?php echo $this->Html->link(__(''), array('action' => 'like', $post['Post']['id']),array('class'=>'vote-down')); ?></div>-->
		</div>
		<hr>
	</div>
	<?php endforeach; ?>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li>
			<?php echo $this->Html->link(__('Poser une question'), array('action' => 'add')); ?></li>
	</ul>
</div>
