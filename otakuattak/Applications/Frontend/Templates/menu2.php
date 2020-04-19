<nav class="nav">
    <ul>
        <?php
        foreach ($listeMenu as $menu){
        ?>
            <li><a href="<?php echo $menu['chemin'];?>"><?php echo $menu['name'];?></a></li>
        <?php
        }
        ?>
    </ul>
</nav>