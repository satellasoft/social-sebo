<header>
    <nav class="center">
        <ul>
            <li>
                <a href="{{BASE}}" aria-label="Social Sebo Logo">
                    <img src="{{BASE}}assets/img/logo/social-sebo-logo.svg" alt="Social Sebo Logo">
                </a>
            </li>
            <li><a href="#">Categoria</a>
                <ul>
                    <li><a href="{{BASE}}categoria/horror">Horror</a></li>
                    <li><a href="{{BASE}}categoria/comedia">Comédia</a></li>
                </ul>
            </li>
            <li><a href="{{BASE}}about/">Quem Somos</a></li>
            <li>
                {% if userName == null %}
                <a href="{{BASE}}login">Entrar</a>
                {% else %}
                <a href="{{BASE}}dashboard">{{userName}}</a>
                {% endif %}
            </li>
        </ul>
    </nav>
</header>