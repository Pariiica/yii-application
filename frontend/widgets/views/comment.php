<?php

/** @var \common\models\Video $video */
/** @var \common\models\Comment $comments */

use common\models\Comment;
use yii\helpers\Html; ?>

<style>
    .reply-btn {
        background: transparent;
        border: none;
        text-decoration: none;
        font-size: smaller;
        color: #8e8a80;
    }
    .comment-reply {
        list-style: url("https://img.icons8.com/ios/15/reply-arrow--v1.png");
    }
    .reply-commenter-name {
        font-size: smaller;
    }
</style>

<div class="comment-section">
    <div class="add-comment">
        <h4>Add a comment</h4>
        <?= Html::beginForm(['comment/create']) ?>
        <div class="form-group">
            <label for="comment-text">Comment</label>
            <textarea id="comment-text" name="Comment[text]" class="form-control" rows="3"></textarea>
            <input type="hidden" name="Comment[video_id]" value="<?= $video->id ?>">
            <input type="hidden" name="Comment[channel_id]" value="<?= $video->channel_id ?>">
            <input type="hidden" name="Comment[parent_id]" value="<?= Yii::$app->request->get('parent_id') ?>">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
        <?= Html::endForm() ?>
        <h3>Comments</h3>
        <?php foreach ($comments as $comment):
//            $replies = Comment::find()->where(['parent_id' => $comment->id])->all();
        ?>
            <div class="comment">
                <div class="commenter-info">
                    <?= Html::img(['file/image', 'path' => $video->image], ['style'=> 'width: 2rem; height: 2rem; border-radius: 50%']) ?>
                    <span class="commenter-name">User</span>
                </div>
                <button class="reply-btn">
                    <?= Html::a('Reply', ['video/view' , 'id' => $video->id, 'parent_id'=> $comment->id])?>
                </button>
                <p class="comment-text"><?= $comment->text ?></p>
                <?php if ($replies = $comment->replies): ?>
                    <ul class="comment-replies">
                        <?php foreach ($replies as $reply): ?>
                            <li class="comment-reply">
                                <div class="reply-commenter-info">
                                    <?= Html::img(['file/image', 'path' => $video->image], ['style'=> 'width: 1.5rem; height: 1.5rem; border-radius: 50%']) ?>
                                    <span class="reply-commenter-name">User</span>
                                </div>
                                <div class="reply-content">
                                    <p class="reply-text"><?= $reply->text ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

