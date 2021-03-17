<div class="container" style="max-width:50em;">
    <div class="d-flex">
        <div class="col ratio ratio-1x1 m-1 rounded bg-purple text-center">
            <h1 class="text-white">></h1>
        </div>
        <?php
            $disabled = '';
            for($i=1; $i<12; $i++) {
                if ($i > 1) {
                    $disabled = 'disabled';
                }
                printf('
        <div class="col ratio ratio-1x1 m-1">
            <label for="purple-%1$s" class="d-none">Purple %1$s</label>
            <input type="text" name="purple-%1$s" id="purple-%1$s" class="rounded border border-3 border-purple text-center" %2$s>
        </div>', $i, $disabled);
            }
        ?>
    </div>
</div>