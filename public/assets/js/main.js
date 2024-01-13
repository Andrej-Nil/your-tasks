'use strict'

class Service {
    constructor() {
        this.POST = 'POST';
        this.GET = 'GET';
        this.PUT = 'PUT';
        this.PATCH = 'PATCH'
        this.DELETE = 'DELETE';
    }

    patch = async (api, data) => {

        if(data instanceof FormData){
            data.append('_method', this.PATCH);
        } else {
            data._method = this.PATCH;
        }

        const response = await this.getData(api, this.POST, data);

        if (response.ok) {
            return await response.json()
        } else {
            return {error: 'Что то пошло не так! Поробуйте позже.'};
        }
    }

    post = async (api, data) => {
        const response = await this.getData(api, this.POST, data);
        if (response.ok) {
            return await response.json()
        } else {
            return {error: 'Что то пошло не так! Поробуйте позже.'};
        }
    }

    destroy = async (api, data) => {
        if(data instanceof FormData){
            data.append('_method', this.DELETE);
        } else {
            data._method = this.DELETE;
        }
        const response = await this.getData(api, this.POST, data);
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

    createFormData = (data) =>{
        const formData = new FormData();
        for (let key in data) {
            formData.append(`${key}`, data[key])
        }
        return formData;

    }

}

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
        this.spinner = spinner;
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


class Tasks{
    constructor() {
        this.taskController = new TaskController();
    }
}

class Notes{
    constructor() {
        const noteController = new NoteController();
    }
}




class NoteController{
    constructor() {
        this.$noteStore = document.querySelector('#noteStore');
        this.init()

    }

    init = () => {
        if(!this.$noteStore) return;
        this.model = new NoteModel();
        this.view = new NoteView( this.$noteStore);
        this.listeners();
    }

    sendForm = async (e) => {
        e.preventDefault()
        const $form = e.target;
        const formData = new FormData($form);
        // this.view.spinner()
        const res = await this.model.store(formData);
        if(res.success){
            this.successCreate(res.data)
        } else if(res.error){
            this.errorCreate(res.error, $form)
        }

    }

   deleteHandler = async ($target) => {
       const $note = $target.closest('[data-note]');
       const id = $note.dataset.note;

       const $result = await this.model.delete({id});
       if ($result.success) {
            this.successDelete($result)
       } else if ($result.error) {
           this.errorDelete($result.error)
       }

   }

    deleteAllHandler = async () => {
        const $result = await this.model.deleteAll();
        console.log($result)
        if ($result.success) {
            this.view.clearList()
        } else if ($result.error) {
            this.errorDelete($result.error)
        }

    }
       successCreate =  (data) => {
        this.view.closeMaker();
        this.view.create(data);
        this.view.clearForm();
    }

       errorCreate = (errors, $form) => {
        this.view.formErrors(errors, $form);
    }

    successDelete = (data) => {
        this.view.deleteNote(data.data.id)
    }

    errorDelete = (error) => {
        console.log(error)
    }



    submitHandler = async (e) => {
        if(e.target.closest('#noteMaker')){
            await this.sendForm(e)
        }


    }

    clickHandler = async (e) => {
        if(e.target.closest('[data-maker-open]')){
            this.view.openMaker();
        } else if(e.target.closest('[data-maker-close]')){
            this.view.closeMaker();
        } else if(e.target.closest('[data-delete-note]')) {
            await this.deleteHandler(e.target);
        } else if(e.target.closest('[data-delete-all]')){
            await this.deleteAllHandler();
        }

        // if(!e.target.closest('#noteMaker') && this.isOpen){
        //
        // }

    }



    listeners = () => {

        document.addEventListener('submit', this.submitHandler)
        document.addEventListener('click', this.clickHandler)
    }
}

class NoteModel extends Service{
    constructor() {
        super();
        this.base = 'api/notes';
        this.createApi = this.base + '/store'
        this.destroyApi = this.base + '/delete'
        this.destroyAlLApi = this.base + '/delete/all'
    }

    store = async (data) => {
        return await this.post(this.createApi, data);
    }

    delete = async (data) => {
        return await this.destroy(this.destroyApi, data)
    }

    deleteAll = async () => {
        return await this.destroy(this.destroyAlLApi, {});
    }


}

class NoteView extends Render{
    constructor($noteStore) {
        super();
        this.$noteStore = $noteStore;
        this.spinner = spinner;
        this.init()
    }

    init = () =>{
        this.$maker = document.querySelector('#noteMaker');
        this.$noteList = document.querySelector('#noteList');
        this.$input = this.$maker.querySelector('[data-maker-input]');
        // this.$radioList = this.$maker.querySelectorAll('[data-maker-color]')
        this.$messages = this.$maker.querySelector('[data-messages]');
        this.isOpenForm = false;


    }

    openMaker = () => {
        this.$maker.classList.add('open');
        this.isOpenForm = true;
        this.$input.focus();
    }

    closeMaker = () => {
        this.$maker.classList.remove('open');
        this.isOpenForm = false;
    }

    formErrors(errors){
        this.clearMessages();
        this.render(this.$messages, this.getErrorMakerHtml, false, errors)
    }

    clearMessages = () => {
        this.clear(this.$messages);
    }

    clearForm = () => {
        setTimeout(() => {
            this.$maker.reset();
        }, 300);


    }

    clearList = () => {
        this.clear(this.$noteList);
    }

    deleteNote = (id) => {
        const $note = this.$noteList.querySelector(`[data-note='${id}']`);
        this.delete($note);
    }



    create = (data) => {
        this.render(this.$noteList, this.getNoteHtml, data, false, 'afterbegin');
    }

    getNoteHtml = (data) => {
        return `
             <div data-note="${data.id}" class="note-card ${data.color}">
              <div class="note-card__text">
                  ${data.text}
              </div>
              <button data-delete-note class="note-card__btn btn btn--icon">
                  <img src="./assets/img/icons/trash.svg" alt="" class="btn__icon">
              </button>
          </div>
        `
    }


    getErrorMakerHtml = (error) => {
        return `<p class="note-marker__error">${error}</p>`
    }


}



// const log = new Log();
const spinner = new Spinner();
const tasks = new Tasks();
const notes = new Notes();









