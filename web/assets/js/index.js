new Vue({
    delimiters: ['${', '}'],
    el: "#app",
    data: {
        headerOn: true,
        inputError: false,
        seeDone: false,
        title: "TodoList",
        todoInput: "",
        todos: [],
    },
    methods: {
        InitApp: function () {
            this.$http.get('http://localhost/todovue/web/app_dev.php/api/todos').then(
                (response) => {
                    console.log("Success :" + response);
                    this.headerOn = false;
                    this.todos = response.body;
                },
                (err) => {
                    console.log("Error :" + err);
                    this.todos = err.body;

                })
        },
        postTodo: function () {
            if (this.todoInput) {
                let content = this.todoInput;
                this.todoInput = "";
                this.inputError = false;

                this.$http.post('http://localhost/todovue/web/app_dev.php/api/todos', {content: content}).then(
                    (response) => {
                        this.todos.push(response.body);
                    },
                    (err) => {
                        console.log(err);
                    }
                )
            } else this.inputError = true;
        },
        setIsDone: function (todo) {
            console.log(todo);
            console.log(!todo.is_done);
            let content = {
                content: todo.content,
                isDone: !todo.is_done
            };
            this.$http.put('http://localhost/todovue/web/app_dev.php/api/todos/' + todo.id, content).then(
                (response) => {
                    console.log(response);
                    todo.is_done = !todo.is_done;
                },
                (err) => {
                    console.log(err);
                }
            )
        },
        deleteTodo: function (index, todoId) {
            this.$http.delete('http://localhost/todovue/web/app_dev.php/api/todos/' + todoId + "/delete").then(
                (response) => {
                    this.todos.splice(index, 1);
                },
                (err) => {
                    console.log(err);
                }
            )
        },

    }

})