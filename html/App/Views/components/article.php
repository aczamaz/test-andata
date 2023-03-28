<div id="app" class="articale __container">
    <div class="article__text">
        Процесс разработки ПО охватывает проектирование, создание документации, программирование, тестирование и непрерывное техническое обслуживание программного продукта. Эти составляющие образуют конвейер рабочего процесса — последовательность этапов, с помощью которых создаются высококачественные программные продукты. Такой конвейер называется жизненным циклом разработки программного обеспечения. <br>
        Несмотря на множество нюансов, жизненный цикл разработки программного обеспечения обычно складывается из перечисленных ниже типичных этапов.
    </div>
    <div v-if="isLoad == true" class="lds-dual-ring"></div>
    <div v-else-if="isLoad == false" class="article-coments">
        <div class="article-coments__label">Коментарии:</div>
        <div v-for="comment in comments" class="article-coments__coment">
            <div class="article-comments__header">
                <div class="article-comments__title">
                    {{comment.title}}
                </div>
                <div class="article-comments__author">
                    {{comment.name}} • {{comment.email}}
                </div>
            </div>
            <div class="article-comments__body">
                {{comment.text}}
            </div>
            <div class="article-comments__data">
                {{comment.created_at}}
            </div>
        </div>
    </div>
    <form class="article__form form">
        <div class="form__title">Напишите коментарий:</div>
        <div v-bind:class="{ error: error.name }" class="form__field">
            <input v-model="form.name" type="text" require placeholder="Имя">
        </div>
        <div v-bind:class="{ error: error.email }" class="form__field">
            <input v-model="form.email" type="email" require placeholder="Почта">
        </div>
        <div v-bind:class="{ error: error.title }" class="form__field">
            <input v-model="form.title" type="text" require placeholder="Заголовок">
        </div>
        <div v-bind:class="{ error: error.text }" class="form__field">
            <textarea v-model="form.text" name="text" id="form__text" require cols="30" placeholder="Текст" rows="10"></textarea>
        </div>
        <button :disabled='!canSend' @click.self.prevent="addComent" class="form__button">отправить</button>
    </form>
</div>