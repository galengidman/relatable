jQuery(function($) {

    $('.relatable-channel').each(function() {
        var $this = $(this);
        var channel = $this.data('relatable-channel');

        $this.find('.relatable-list').sortable({
            connectWith: '[data-relatable-channel="' + channel + '"] .relatable-list',
            receive: function(ev, ui) {
                var $input = ui.item.find('input');
                var $list = ui.item.closest('.relatable-list');
                var inputName = $input.attr('name');

                if ($list.data('relatable-list') === 'unselected') {
                    inputName = inputName.replace('[selected]', '[unselected]');
                } else {
                    inputName = inputName.replace('[unselected]', '[selected]');
                }

                $input.attr('name', inputName);
            },
        });
    });

});
