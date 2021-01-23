import $ from 'jquery';

class MyNotes {
    constructor() {
        this.events();
    }

    events() {
        /* Setting event listener on #my-notes (parent element of .delete-note) means that newly created elements will still be found */
        $('#my-notes').on('click', '.delete-note', this.deleteNote);
        $('#my-notes').on('click', '.edit-note', this.editNote.bind(this));
        $('#my-notes').on('click', '.update-note', this.updateNote.bind(this));
        $('.submit-note').on('click', this.createNote.bind(this));
    }

    //custom methods


    editNote(e) {
        var thisNote = $(e.target).parents('li');
        if (thisNote.data('state') == 'editable') {
            this.makeNoteReadOnly(thisNote);
        } else {
            this.makeNoteEditable(thisNote);
        }
    }

    makeNoteEditable(thisNote) {
        thisNote.find('.edit-note').html('<i class="fa fa-times" aria-hidden="true"></i> Cancel');
        thisNote.find('.note-title-field, .note-body-field').removeAttr('readonly').addClass('note-active-field');
        thisNote.find('.update-note').addClass('update-note--visible');
        thisNote.data('state', 'editable');
    }

    makeNoteReadOnly(thisNote) {
        thisNote.find('.edit-note').html('<i class="fa fa-pencil" aria-hidden="true"></i> Edit');
        thisNote.find('.note-title-field, .note-body-field').attr('readonly', 'readonly').removeClass('note-active-field');
        thisNote.find('.update-note').removeClass('update-note--visible');
        thisNote.data('state', 'cancel');
    }

    deleteNote(e) {
        var thisNote = $(e.target).parents('li');
        $.ajax({
            //include authorization (nonce) using our custom variable that is set up in functions.php
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', university_data.nonce);
            },
            url: university_data.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'DELETE',
            success: (response) => {
                //removes note and slides up
                thisNote.slideUp();
                console.log('it\'s gone');
                console.log(response);
                if (response.user_note_count < 5) {
                    $('.note-limit-message').removeClass('active');
                }
            },
            error: (response) => {
                console.log('sorry');
                console.log(response);
            },
        });
    }

    updateNote(e) {
        var thisNote = $(e.target).parents('li');
        
        var ourUpdatedPost = {
            'title': thisNote.find('.note-title-field').val(),
            'content': thisNote.find('.note-body-field').val(),
        }

        $.ajax({
            //include authorization (nonce) using our custom variable that is set up in functions.php
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', university_data.nonce);
            },
            url: university_data.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'POST',
            data: ourUpdatedPost,
            success: (response) => {
                console.log('post update');
                console.log(response);
                this.makeNoteReadOnly(thisNote);
            },
            error: (response) => {
                console.log('sorry');
                console.log(response);
            },
        });
    }

    createNote(e) {
        var ourNewPost = {
            'title': $('.new-note-title').val(),
            'content': $('.new-note-body').val(),
            'status': 'publish',
        }

        $.ajax({
            //include authorization (nonce) using our custom variable that is set up in functions.php
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', university_data.nonce);
            },
            url: university_data.root_url + '/wp-json/wp/v2/note/',
            type: 'POST',
            data: ourNewPost,
            success: (response) => {
                console.log('post created');
                console.log(response);
                //clear the input and textarea
                $('.new-note-title, .new-note-body').val('');
                $(`
                <li data-id="${response.id}">
                <input readonly class="note-title-field" value="${response.title.raw}"/>
                <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span>
                <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span>
                <textarea readonly class="note-body-field">${response.content.raw}</textarea>
                <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i>Save</span>
            </li>`).prependTo('#my-notes').hide().slideDown();
            },
            error: (response) => {
                if (response.responseText == 'You have reached your note limit.') {
                    $('.note-limit-message').addClass('active');
                }
                console.log('sorry');
                console.log(response);
                alert(response.responseText);
            },
        });
    }
}

export default MyNotes;