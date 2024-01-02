
<nav id="sidebar" style="min-height: 90vh;" class="fixed-top" >
    <div class="sidebar-header">
        <h3>Sidebar Panel</h3>
        <strong>SP</strong>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="/" class="nav-link">
                <i class="fa fa-home"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{route('admin.category')}}" class="nav-link">
                <i class="fa fa-bars"></i>
                Kategori
            </a>
        </li>
        <li>
            <a href="{{route('admin.book')}}" class="nav-link">
                <i class="fa fa-book"></i>
                Buku
            </a>
        </li>
        <li>
            <a href="logout.php" class="nav-link">
                <i class="fa fa-power-off"></i>
                Logout
            </a>
        </li>
    </ul>
</nav>
<style>
    #sidebar {
        min-width: 250px;
        max-width: 250px;
        background: #4E5D6C;
        color: #fff;
        transition: all 0.3s;
        /* Tambahkan properti CSS agar sidebar dapat mengikuti scroll */
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        overflow-y: auto;
    }

    #sidebar a {
        padding: 10px;
        font-size: 16px;
        color: #fff;
        display: block;
        transition: all 0.3s;
    }

    #sidebar a:hover {
        background: #5fa2db;
        color: #fff;
        text-decoration: none;
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: #546373;
    }

    #sidebar .bi {
        margin-right: 10px;
    }

    #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #47748b;
    }

    #sidebar ul p {
        padding: 10px;
        font-size: 16px;
        display: block;
    }
</style>
