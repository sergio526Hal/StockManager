<h1>Bienvenue<?= session() -> get('username') ?></h1>
<a href="<?= site_url('logout') ?>">Deconnection</a>