<script type="text/javascript">


    document.addEventListener('DOMContentLoaded', function () {

        const tabs = document.querySelectorAll('.nav-tabs .nav-link');

        const pageKey = window.location.pathname + '-lastActiveTab';
        const timeKey = window.location.pathname + '-lastActiveTime';

        const lastActiveTabId = localStorage.getItem(pageKey);
        const lastActiveTime = localStorage.getItem(timeKey);

        const currentTime = new Date().getTime();
        const timeLimit = 10 * 60 * 1000;

        if (lastActiveTabId && lastActiveTime && (currentTime - lastActiveTime < timeLimit)) {

            const lastActiveTab = document.querySelector(`[data-tab-id="${lastActiveTabId}"]`);
            if (lastActiveTab) {
                new bootstrap.Tab(lastActiveTab).show();
            }
        } else {

            const firstTab = tabs[0];
            if (firstTab) {
                new bootstrap.Tab(firstTab).show();
            }

            localStorage.removeItem(pageKey);
            localStorage.removeItem(timeKey);
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                const tabId = this.getAttribute('data-tab-id');
                const currentTime = new Date().getTime();

                localStorage.setItem(pageKey, tabId);
                localStorage.setItem(timeKey, currentTime);
            });
        });
    });

</script>

