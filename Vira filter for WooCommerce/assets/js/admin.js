jQuery(function ($) {
    const builder = $('#vira-filter-builder');
    const hiddenInput = $('#vira_elements_json');
    let elements = builder.data('elements') || [];

    function renderBuilder() {
        builder.empty();
        elements.forEach((el, i) => {
            const item = $(`
                <div class="vira-element">
                    <strong>${el.label || el.type}</strong> (${el.type})
                    <a href="#" class="edit" data-index="${i}">Edit</a> |
                    <a href="#" class="remove" data-index="${i}">Remove</a>
                </div>
            `);
            builder.append(item);
        });

        builder.append('<button id="add-element" class="button button-primary">+ Add Element</button>');
        hiddenInput.val(JSON.stringify(elements));
    }

    builder.on('click', '#add-element', function (e) {
        e.preventDefault();
        const type = prompt('Type (checkbox, select, slider, reset):');
        if (!type) return;
        elements.push({ type, label: type });
        renderBuilder();
    });

    builder.on('click', '.remove', function (e) {
        e.preventDefault();
        const i = $(this).data('index');
        elements.splice(i, 1);
        renderBuilder();
    });

    renderBuilder();
});
