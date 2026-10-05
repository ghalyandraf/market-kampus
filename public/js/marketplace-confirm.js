(function () {
    var pendingForm = null;
    var isConfirmedSubmit = false;

    function actionText(form) {
        var override = (form.getAttribute('data-confirm') || '').trim();

        if (override) {
            return {
                title: override,
                copy: 'Pastikan data sudah benar sebelum lanjut.',
                danger: false,
            };
        }

        var methodInput = form.querySelector('input[name="_method"]');
        var method = methodInput ? methodInput.value.toUpperCase() : (form.method || 'GET').toUpperCase();
        var action = (form.getAttribute('action') || '').toLowerCase();
        var submitter = document.activeElement && document.activeElement.matches('button, input[type="submit"]')
            ? document.activeElement
            : form.querySelector('button[type="submit"], input[type="submit"]');
        var label = submitter ? (submitter.textContent || submitter.value || '').trim().toLowerCase() : '';

        if (method === 'DELETE' || label.includes('hapus')) {
            return {
                title: 'Hapus data ini?',
                copy: 'Data yang dihapus tidak bisa dipakai lagi dari halaman ini.',
                danger: true,
            };
        }

        if (method === 'PUT' || label.includes('update') || label.includes('verifikasi')) {
            return {
                title: 'Simpan perubahan?',
                copy: 'Perubahan akan langsung diterapkan setelah kamu lanjut.',
                danger: false,
            };
        }

        if (action.includes('checkout') || label.includes('checkout') || label.includes('pesanan')) {
            return {
                title: 'Buat pesanan sekarang?',
                copy: 'Cek alamat dan detail pesanan sebelum diproses.',
                danger: false,
            };
        }

        if (action.includes('cart') || label.includes('keranjang')) {
            return {
                title: 'Tambahkan ke keranjang?',
                copy: 'Produk akan masuk ke keranjang belanjamu.',
                danger: false,
            };
        }

        if (action.includes('logout') || label.includes('logout')) {
            return {
                title: 'Keluar dari akun?',
                copy: 'Kamu perlu login lagi untuk memakai dashboard.',
                danger: true,
            };
        }

        return {
            title: 'Lanjutkan aksi ini?',
            copy: 'Pastikan semua data sudah sesuai sebelum lanjut.',
            danger: false,
        };
    }

    function shouldSkip(form) {
        var action = (form.getAttribute('action') || '').toLowerCase();

        return form.hasAttribute('data-confirm-skip')
            || action.endsWith('/login')
            || action.endsWith('/register');
    }

    function ensureModal() {
        var existing = document.getElementById('marketplaceConfirm');

        if (existing) {
            return existing;
        }

        ensureStyles();

        var overlay = document.createElement('div');
        overlay.id = 'marketplaceConfirm';
        overlay.className = 'confirm-overlay';
        overlay.innerHTML = [
            '<div class="confirm-dialog" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">',
            '<div class="confirm-mark" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 9v4"/><path d="M12 17h.01"/><path d="M10.3 4.9 2.7 18a2 2 0 0 0 1.7 3h15.2a2 2 0 0 0 1.7-3L13.7 4.9a2 2 0 0 0-3.4 0Z"/></svg></div>',
            '<h2 class="confirm-title" id="confirmTitle">Lanjutkan aksi ini?</h2>',
            '<p class="confirm-copy" id="confirmCopy">Pastikan semua data sudah sesuai sebelum lanjut.</p>',
            '<div class="confirm-actions">',
            '<button type="button" class="confirm-cancel">Batal</button>',
            '<button type="button" class="confirm-approve">Lanjutkan</button>',
            '</div>',
            '</div>',
        ].join('');

        document.body.appendChild(overlay);

        overlay.querySelector('.confirm-cancel').addEventListener('click', closeModal);
        overlay.addEventListener('click', function (event) {
            if (event.target === overlay) {
                closeModal();
            }
        });
        overlay.querySelector('.confirm-approve').addEventListener('click', function () {
            if (!pendingForm) {
                return;
            }

            isConfirmedSubmit = true;
            pendingForm.submit();
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        return overlay;
    }

    function ensureStyles() {
        if (document.getElementById('marketplaceConfirmStylesheet')) {
            return;
        }

        var link = document.createElement('link');
        link.id = 'marketplaceConfirmStylesheet';
        link.rel = 'stylesheet';
        link.href = '/css/marketplace-confirm.css?v=20261005c';
        document.head.appendChild(link);
    }

    function closeModal() {
        var modal = document.getElementById('marketplaceConfirm');

        if (modal) {
            modal.classList.remove('is-open');
        }

        pendingForm = null;
    }

    function openModal(form) {
        var modal = ensureModal();
        var text = actionText(form);
        var approve = modal.querySelector('.confirm-approve');

        pendingForm = form;
        modal.querySelector('#confirmTitle').textContent = text.title;
        modal.querySelector('#confirmCopy').textContent = text.copy;
        approve.classList.toggle('is-danger', text.danger);
        approve.textContent = text.danger ? 'Ya, lanjut' : 'Lanjutkan';
        modal.classList.add('is-open');
        modal.querySelector('.confirm-cancel').focus();
    }

    document.addEventListener('submit', function (event) {
        var form = event.target;

        if (!(form instanceof HTMLFormElement) || shouldSkip(form) || isConfirmedSubmit) {
            isConfirmedSubmit = false;
            return;
        }

        event.preventDefault();
        openModal(form);
    }, true);
})();
