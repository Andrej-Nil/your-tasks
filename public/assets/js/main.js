'use strict'

class Service {
    constructor() {
        this.POST = 'POST';
        this.GET = 'GET';
        this.PUT = 'PUT';
        this.PATCH = 'PATCH'
        this.DELETE = 'DELETE';
        this.DELETE = 'DELETE';
    }

    patch = async (api, data) => {
        const body = {
            ...data,
            _method: this.PATCH,
        }
        const response = await this.getData(api, this.POST, body);

        if (response.ok) {
            return await response.json()
        } else {
            return {error: 'Что то пошло не так! Поробуйте позже.'};
        }
    }

    getData = (api, method, body) => {
        return fetch(api, {
            method: method,
            body: new URLSearchParams(body)
        })
    }

}

class Log {
    error = (message = 'Произошла ошибка') => {
        console.error(message);
    }
}

// this.declForTotalFindedItem = ['', 'а', 'ов'];
class Render {
    delete = ($element) => {
        if (!$element) {
            return;
        }
        $element.remove();
    }

    clear = ($element) => {
        if (!$element) {
            return;
        }
        $element.innerHTML = '';
    }

    render = ($parent, getHtmlMarkup, argument = false, array = false, where = 'beforeend') => {
        let markupAsStr = '';
        if (!$parent) {
            return;
        }

        if (array) {
            array.forEach((item) => {
                markupAsStr = markupAsStr + getHtmlMarkup(item);
            })
        }
        if (argument) {
            markupAsStr = getHtmlMarkup(argument);
        }

        if (!array && !argument) {
            markupAsStr = getHtmlMarkup();
        }
        $parent.insertAdjacentHTML(where, markupAsStr);
    }
}

class Spinner extends Render {


    create = ($parent) => {
        this.render($parent, this.html);
    }

    destroy = ($parent) => {
        const $spinner = $parent.querySelector('[data-spinner]');
        this.delete($spinner);
    }
    html = (message = 'Идет обработка запроса!') => {
        return `
      <div data-spinner class="spinner">
        <p class="spinner__message">${message}</p>
      </div>
    `
    }
}

class TaskController {
    constructor() {
        this.init();
    }

    init = () => {
        this.model = new TaskModel();
        this.view = new TaskView();
        this.listeners();
    }


    actionHandler = async ($btn) => {
        const $task = $btn.closest('[data-task]');
        this.view.showSpinner($task);
        const type = $btn.dataset.action;
        const id = this.getId($task);
        const res = await this.model.action({id, type});
            if (res.success) {
                this.view.hideSpinner($task);
                this.view.changeStatusHandler($task, res);
            } else if (res.error) {
                this.view.hideSpinner($task);
                console.log(res);
            }
    }

    getId = ($task) => {
        return $task.dataset.task;
    }


    clickHandler = async (e) => {
        if (e.target.closest("[data-action]")) {
            await this.actionHandler(e.target.closest("[data-action]"));
        }
    }

    listeners = () => {
        document.addEventListener('click', this.clickHandler);
    }
}

class TaskModel extends Service {
    constructor() {
        super();
        this.base = '/api/tasks/';
        this.pauseApi = this.base + 'pause';
        this.activateApi = this.base + 'activate';
        this.completeApi = this.base + 'complete';
        this.cancelApi = this.base + 'cancel';
        this.returnApi = this.base + 'return';

    }

    action = async (data) => {
        const api = this.base + data.type;
        return await this.patch(api, data);
    }

}

class TaskView extends Render {
    constructor() {
        super();
        this.init();
    }

    init = () => {
        this.spinner = new Spinner();
        this.statusList = [
            'pause', 'active', 'completed', 'overdue', 'cancelled'
        ];

        // this.PAUSE = 'pause';
        // this.ACTIVE = 'active';
        // this.COMPLETED = 'completed';
        // this.OVERDUE = 'overdue';
        // this.CANCELLED = 'cancelled';
    }

    showSpinner = ($task) => {
        this.spinner.create($task);
    }

    hideSpinner = ($task) => {
        this.spinner.destroy($task);
    }

    changeStatusText = (statusText, $task) => {
        const $statusText = $task.querySelector('[data-status-text]');
        $statusText.innerHTML = statusText;
    }

    changeActivateBtn = (data, $task) => {
        const $btn = $task.querySelector('[data-action="activate"]');
        const $iconBtn = $btn.querySelector('[data-icon]');
        $btn.dataset.action = 'pause';
        $iconBtn.src = data.icon;
    }

    addActivateBtn = (data, $task) => {
        const props = {
            action:'pause',
            icon: data.icon
        }
        const $controlsBlock = $task.querySelector('[data-controls]');
        this.render($controlsBlock, this.getActionBtnHtml, props, false,  'afterBegin');
    }

    addCompleteBtn = (data, $task) => {
       const props = {
           action:'complete',
           icon: data.completeIcon
       }
        const $controlsBlock = $task.querySelector('[data-controls]');
        this.render($controlsBlock, this.getActionBtnHtml, props, false,  'afterBegin');
    }

    changePauseBtn = (data, $task) => {
        const $btn = $task.querySelector('[data-action="pause"]');
        const $iconBtn = $btn.querySelector('[data-icon]');
        $btn.dataset.action = 'activate';
        $iconBtn.src = data.icon;
    }

    changeCancelBtn = ($task) => {
        const $btn = $task.querySelector('[data-action="cancel"]');
        $btn.classList.remove('btn--cancel');
        $btn.classList.add('btn--action');
        $btn.dataset.action = 'resume';
        $btn.innerHTML = 'Вернуть';
    }

    changeResumeBtn = ($task) => {
        const $btn = $task.querySelector('[data-action="resume"]');
        $btn.classList.remove('btn--action');
        $btn.classList.add('btn--cancel');
        $btn.dataset.action = 'cancel';
        $btn.innerHTML = 'Отмена';
    }

    deleteActionBtn = ($task, except = '') => {
        const $buttons = $task.querySelectorAll('[data-action]');

        $buttons.forEach(($item) => {
            if($item.dataset.action === except) return;
            this.delete($item);
        })
    }

    activate = (data, $task) => {
        this.changeColor(data, $task);
        this.changeStatusText(data.statusText, $task);
        this.changeActivateBtn(data, $task)
    }

    pause = (data, $task) => {
        this.changeColor(data, $task);
        this.changeStatusText(data.statusText, $task);
        this.changePauseBtn(data, $task);
    }

    complete = (data, $task) => {
        this.changeColor(data, $task);
        this.changeStatusText(data.statusText, $task);
        this.deleteActionBtn($task);
    }

    cancel = (data, $task) => {
        this.changeColor(data, $task);
        this.changeStatusText(data.statusText, $task);
        this.deleteActionBtn($task, 'cancel');
        this.changeCancelBtn($task);
    }

    resume = (data, $task) => {
        this.changeColor(data, $task);
        this.changeStatusText(data.statusText, $task);
        this.changeResumeBtn($task);
        this.addCompleteBtn(data, $task);
        this.addActivateBtn(data, $task);



    }

    changeColor = (data, $task) => {
        const isOverdue = data.isOverdue;
        this.statusList.forEach( (item) => {
            $task.classList.remove(item);
        });
        if(isOverdue) {
            $task.classList.add(isOverdue)
        } else {
            $task.classList.add(data.status)
        }
    }

    changeStatusHandler = ($task, response) => {
        const data = response.data;
        switch (response.data.action){
            case 'activate': {
                this.activate(data, $task);
                break;
            }
            case 'pause': {
                this.pause(data, $task);
                break;
            }
            case 'complete': {
                this.complete(data, $task);
                break;
            }
            case 'cancel': {
                this.cancel(data, $task);
                break;
            }
            case 'resume': {
                this.resume(data, $task);
                break;
            }
            default:{
                break;
            }
        }
    }

    getActionBtnHtml = (props) => {
        return `
            <button data-action="${props.action}" class="btn btn--icon">
                <img data-icon class="btn__icon" src="${props.icon}" alt="">
            </button>
        `
    }
}


class Task{
    constructor() {
        this.taskController = new TaskController();
    }
}


class NoteMaker{
    constructor() {
        this.$noteMaker =  document.querySelector('#noteMaker');
        this.init();
    }

    init = () => {
        if(!this.$noteMaker) return;
        this.$input = this.$noteMaker.querySelector('[data-maker-input]')
        this.isOpen = false;
        this.listeners();
    }

    open = () => {
        this.$noteMaker.classList.add('open');
        this.isOpen = true;
        this.$input.focus()
    }

    close = () => {
        this.$noteMaker.classList.remove('open');
        this.isOpen = false;
    }

    clickHandler = (e) => {
        if(e.target.closest('[data-maker-open]')){
            this.open();
            return;
        }

        if(e.target.closest('[data-maker-close]')){
            this.close();
            return;
        }

        if(!e.target.closest('#noteMaker') && this.isOpen){

        }

    }
    listeners = () => {
        document.addEventListener('click', this.clickHandler);
    }
}

class NoteStore{
    constructor() {
        this.$noteStore = document.querySelector('#noteStore');
        this.init();
    }

    init = () => {
        if(!this.$noteStore) return;
        this.noteMaker = new NoteMaker();


    }


}


// const log = new Log();
// const spinner = new Spinner();
const task = new Task();
const noteStore = new NoteStore();








