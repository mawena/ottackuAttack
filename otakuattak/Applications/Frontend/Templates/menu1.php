<nav class="body">
    <div class="side">
        <?php
        foreach ($listeMenu as $menu){
        ?>
            <a href="<?php echo $menu['chemin'];?>" style="background:<?php echo $menu['background'];?>"><?php echo $menu['name'];?></a>
        <?php
        }
        ?>
    </div>
</nav>