<script type="text/javascript">

    document.addEventListener("DOMContentLoaded", () => {

        const siteRoot = window.location.origin;
        const specialPages = [extractBasePath(window.location.href) + '{{$section}}'];
        const previousPage = document.referrer;
        const isSpecialPage = specialPages.some(page => previousPage.includes(siteRoot + page));

        function extractBasePath(url, depth = 2) {
            try {
                const path = new URL(url).pathname;
                const segments = path.split('/').filter(Boolean);
                return '/' + segments.slice(0, depth).join('/');
            } catch (error) {
                console.error("Invalid URL:", error);
                return null;
            }
        }

        function activateTab(tabId) {

            document.querySelectorAll('.nav-link').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(tabContent => tabContent.classList.remove('show', 'active'));
            document.querySelector(`[data-tab-id="${tabId}"]`)?.classList.add('active');
            document.getElementById(tabId)?.classList.add('show', 'active');
        }

        function setDefaultTab() {

            const firstTab = document.querySelector('.nav-link');
            const firstTabContent = document.querySelector('.tab-pane');
            firstTab?.classList.add('active');
            firstTabContent?.classList.add('show', 'active');
        }

        if (isSpecialPage) {
            const activeTab = localStorage.getItem('activeTab');
            activeTab ? activateTab(activeTab) : setDefaultTab();
            document.querySelectorAll('[data-toggle="tab"]').forEach(tabLink => {
                tabLink.addEventListener('click', () => {
                    localStorage.setItem('activeTab', tabLink.getAttribute('data-tab-id'));
                });
            });
        } else {
            setDefaultTab();
        }
    });


</script>

