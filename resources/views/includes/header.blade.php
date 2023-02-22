<header id="header" class="bg-main d-flex align-items-center justify-content-between px-2">
    <button class="btn" type="button">
        <i id="side-icon" class="fas fa-bars"></i>
    </button>
    <div class="d-flex align-items-center">
        <div class="position-relative me-3">
            <button class="btn btn-sm d-flex" type="button">
                <i class="fa-solid fa-bell" style="font-size: 1rem"></i>
            </button>
            {{-- <div class="triangle-up position-absolute" style="width: 0; height: 0; border-left: 12px solid transparent; border-right: 12px solid transparent; border-bottom: 12px solid #dee2e6; z-index: 2;"></div>
            <div class="border border-2 rounded position-absolute" style="height: 500px; width: 300px; background-color: white; z-index: 1; top: 43px; right: -101px;">
            </div> --}}
        </div>
        <div class="dropdown">
            <button class="btn dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">
                <i class="fas fa-user-circle"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="/logout">Log Out</a>
            </div>
        </div>
    </div>
</header>
