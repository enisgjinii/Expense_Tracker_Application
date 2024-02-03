<?php
class Sidebar
{
    private $links = [
        "admin_dashboard.php" => ["Paneli", "bxs-home"],
        "list_of_client.php" => ["Klientet", "bxs-user-account"],
        "income.php" => ["Të ardhurat", "bx-bar-chart-alt-2"],
        "profile.php" => ["Profili im", "bx-user"],
        "categories.php" => ["Kategoritë", "bx-category"],
        "about_us_page.php" => ["About us", "bx-info-circle"],
        "contact_list.php" => ["Formularët e Kontaktit", "bx-message-square-dots"],
    ];

    private $bottomContent = [
        "logout.php" => ["Dilni", "bx-log-out"],
    ];

    public function generateSidebar()
    {
        echo '<nav class="sidebar close">';
        echo '<header>';
        echo '<div class="image-text">';
        echo '<br>';
        echo '<span class="image">';
        echo '<img src="../assets/logo.png" alt="">';
        echo '</span>';
        echo '</div>';
        echo '<i class="bx bx-chevron-right toggle"></i>';
        echo '</header>';
        echo '<div class="menu-bar">';
        echo '<div class="menu">';
        echo '<ul class="menu-links">';

        $this->generateLinks($this->links);

        echo '</ul>';
        echo '</div>';
        echo '<div class="bottom-content">';

        $this->generateLinks($this->bottomContent);

        echo '</div>';
        echo '</div>';
        echo '</nav>';
    }

    private function generateLinks($links)
    {
        foreach ($links as $url => $linkData) {
            $iconClass = $linkData[1];
            $text = $linkData[0];

            echo '<li class="nav-link">';
            echo '<a href="' . $url . '">';
            echo '<i class="bx ' . $iconClass . ' icon"></i>';
            echo '<span class="text nav-text">' . $text . '</span>';
            echo '</a>';
            echo '</li>';
        }
    }
}

// Instantiate the Sidebar class and generate the sidebar
$sidebar = new Sidebar();
$sidebar->generateSidebar();
