    <!-- Navigation -->
<nav class='page_section'>
    <img src="../../images/logo.jpg" alt="Haarlem Festival Logo" />
    <div class="menu">
        <div class="nav-line"></div>
            <a <?php if($active == 'home') { echo'class="active"'; }?> href="/">HOME</a>
            <a <?php if($active == 'jazz') { echo'class="active"'; }?> href="/jazz">JAZZ</a>
            <a <?php if($active == 'dance') { echo'class="active"'; }?> href="/dance">DANCE</a>
            <a <?php if($active == 'food') { echo'class="active"'; }?> href="/food">FOOD</a>
            <a <?php if($active == 'historic') { echo'class="active"'; }?> href="/historic">HISTORIC</a>
            <a <?php if($active == 'tickets') { echo'class="active"'; }?> href="/tickets">TICKETS</a>
        <div class="nav-line"></div>
    </div>
</nav>