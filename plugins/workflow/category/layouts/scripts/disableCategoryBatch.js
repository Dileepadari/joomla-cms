document.addEventListener('DOMContentLoaded', function()
    {
    var dropdown = document.getElementById('toolbar-status-group');
    if (!dropdown){
        return;
    }
    var batchButton = document.getElementById('status-group-children-batch');
    if (batchButton){
        batchButton.addEventListener('click', function()
        {
            var observer = new MutationObserver(function(mutations, observer) {
                var categorySelector = document.getElementById('batch-category-id');
                if (categorySelector) {
                    categorySelector.disabled = true;
                    observer.disconnect();
                }
            });

            observer.observe(document.body, { childList: true, subtree: true });
        });
    }
});
