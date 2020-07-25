<header>
    <nav class="center">
        <ul>
            <li>
                <a href="{{BASE}}" aria-label="Social Sebo Logo">
                    <img src="{{BASE}}assets/img/logo/social-sebo-logo.svg" alt="Social Sebo Logo">
                </a>
            </li>
            <li><a href="{{BASE}}categoria">Categoria</a>
                <ul>
                    <li><a href="{{BASE}}categoria/ver/acao">Ação</a></li>
                    <li><a href="{{BASE}}categoria/ver/comedia">Comédia</a></li>
                    <li><a href="{{BASE}}categoria/ver/terror">Terror</a></li>
                </ul>
            </li>
            <li><a href="{{BASE}}about/">Quem Somos</a></li>

            {% if userName != null %}
            <li>
                <a href="{{BASE}}dashboard">Dashboard</a>
            </li>
            {% endif %}

            {% if userName == null %}
            <li>
                <a href="{{BASE}}login">Entrar</a>
            </li>
            {% else %}
            <li>
                <a href="{{BASE}}dashboard">{{userName}}</a>
                <ul>
                    <li><a href="{{BASE}}login/editar">Editar</a></li>
                    <li><a href="{{BASE}}login/senha">Alterar senha</a></li>
                    <li><a href="{{BASE}}login/logout">Sair</a></li>
                </ul>
            </li>
            {% endif %}

        </ul>
    </nav>
</header>