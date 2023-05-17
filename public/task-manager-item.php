<?php
    $id     = get_the_ID();
    $status = get_post_meta( $id, 'tasks_status', true );
    $date   = get_post_meta( $id, 'tasks_date', true );
    $estimate = get_post_meta( $id, 'tasks_estimate', true );
?>
<div class="card mb-3 task" data-postid="<?php echo esc_html( $id ); ?>">
    <div class="card-header d-flex justify-content-between <?php echo ($status == '1' ? 'text-decoration-line-through' : '' ); ?>">
        <div class="card-title mb-0" contentEditable="true">
            <?php the_title(); ?>
        </div>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
    <div class="card-body">
        <div class="card-content" contentEditable="true">
        <?php
        $content = apply_filters( 'the_content', get_the_content() );
        if( !empty( $content ) ) :
            echo $content;
        else:
            echo '<p>No description..</p>';
        endif;
        ?>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="input-group">
                    <span class="input-group-text" id="date">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                      <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
                    </svg>
                    </span>
                    <input type="text" class="form-control" value="<?php echo $date; ?>" aria-describedby="date">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-group">
                    <span class="input-group-text" id="clock">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock"
                           viewBox="0 0 16 16">
                      <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                    </svg>
                    </span>
                    <input type="number" class="form-control" placeholder="No estimate.." value="<?php echo $estimate; ?>" aria-describedby="clock">
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-success text-white btn-done">Done</a>
    </div>
</div>