# Workflow — Cara Kerja Proyek Ini

**Tanggal:** 2026-09-16
**Model kerja:** Hermes sebagai orkestrator (read-only) + OpenCode sebagai eksekutor kode

---

## 1. Prinsip Inti

1. **Satu penulis kode.** Semua perubahan kode dikerjakan oleh OpenCode. Hermes tidak menulis/mengedit kode aplikasi.
2. **Orkestrator memverifikasi, bukan mempercayai.** Setiap klaim "selesai" dari agen kode wajib diverifikasi ulang lewat perintah read-only.
3. **Checkpoint antar fase.** Jangan lanjut ke fase berikutnya sebelum fase sekarang lulus definisi selesai.
4. **Bukti, bukan narasi.** "16 rute 200" harus disertai output perintah, bukan ringkasan.
5. **Dokumen hidup.** `todo.md` diperbarui setiap fase selesai; note Obsidian diperbarui setiap milestone.

---

## 2. Peran

| Peran | Siapa | Tanggung jawab | Batasan |
|---|---|---|---|
| **Orkestrator** | Hermes | Menyusun spec, mendelegasikan, memverifikasi, memperbarui dokumen | Tidak mengedit kode aplikasi; hanya baca + jalankan perintah verifikasi |
| **Eksekutor** | OpenCode CLI | Menulis/mengubah kode, menjalankan test, membangun frontend | Tidak memutuskan arsitektur; bekerja dari spec |
| **Pemilik produk** | User | Keputusan produk, izin commit/push, data kontak asli | — |

---

## 3. Siklus Kerja per Fase

```
┌─ 1. SPEC ─────────────────────────────────────────────┐
│ Orkestrator menulis spec tugas ke file (mis.          │
│ docs/tasks/F2-sales-resource.md):                     │
│  - tujuan, file yang boleh disentuh                   │
│  - daftar perubahan yang diharapkan                   │
│  - kriteria selesai + perintah verifikasi             │
│  - larangan (jangan sentuh X)                         │
└──────────────────┬────────────────────────────────────┘
                   ▼
┌─ 2. EKSEKUSI ─────────────────────────────────────────┐
│ opencode run '<instruksi>' -f docs/tasks/<spec>.md    │
│ Dijalankan di background + notifikasi saat selesai    │
└──────────────────┬────────────────────────────────────┘
                   ▼
┌─ 3. VERIFIKASI (wajib, read-only) ────────────────────┐
│ Orkestrator memeriksa sendiri:                        │
│  - git status / git diff --stat                       │
│  - isi file kunci (baca langsung)                     │
│  - jalankan test / curl rute / artisan                │
│  - grep untuk pola terlarang                          │
│  - deteksi data hilang / regresi                      │
└──────────────────┬────────────────────────────────────┘
                   ▼
┌─ 4. LAPOR + CHECKPOINT ───────────────────────────────┐
│ Laporan ringkas: berubah apa, file apa, hasil         │
│ verifikasi, sisa masalah. Tandai [x] di todo.md.      │
│ Minta izin sebelum commit/push.                       │
└──────────────────┬────────────────────────────────────┘
                   ▼
              (ulang ke 1)
```

---

## 4. Aturan Delegasi ke OpenCode

**Spec wajib memuat:**
- Tujuan tunggal dan jelas (satu fase per spec)
- Daftar file yang boleh/ tidak boleh disentuh
- Kriteria selesai yang dapat diuji
- Perintah verifikasi yang harus dijalankan agen
- Larangan eksplisit (mis. "jangan ubah `routes/web.php`", "jangan isi nomor palsu")

**Cara memanggil:**
```bash
cd ~/projects/hyundaimks
opencode run '<instruksi singkat>' -f docs/tasks/<spec>.md
```
Jalankan di background dengan notifikasi; jangan polling.

**Yang dilarang bagi agen kode:**
- Mengubah `routes/web.php` yang sudah ada tanpa izin
- Menambah dependency di luar Filament/Laravel tanpa persetujuan
- Menyimpan data sensitif (nomor asli, kredensial) ke dalam kode
- Melakukan `git commit`/`push` tanpa izin eksplisit pemilik
- Menghapus fungsionalitas yang ada tanpa instruksi

---

## 5. Verifikasi (definisi "selesai" yang sah)

Perintah standar:

```bash
# Kesehatan umum
php artisan view:cache              # semua blade valid
php artisan route:list | wc -l      # rute bertambah sesuai rencana
npm run build                       # aset terkompilasi

# Regresi rute publik (harus 200 semua)
for r in / /pricelist /proses-kredit /simulasi-kredit /tes-drive /portofolio /kontak \
         /product/stargazer /product/creta /product/stargazer-x /product/hyundai-kona \
         /product/santa-fe /product/staria /product/ioniq-5 /product/palisade \
         /product/ioniq-6 /product/all-new-santa-fe; do
  printf "%-28s %s\n" "$r" "$(curl -s -o /dev/null -w '%{http_code}' http://127.0.0.1:8000$r)"
done

# Fitur baru
curl -s -o /dev/null -w "%{http_code}\n" http://127.0.0.1:8000/sales/rukman-fadli   # 200
curl -s -o /dev/null -w "%{http_code}\n" http://127.0.0.1:8000/sales/tidak-ada      # 404

# Keamanan & kebersihan
grep -rn "Rukman\|0896-1688" resources/views/ || echo "BERSIH"
grep -rn "justify-space-between\|images\\\\" resources/views/ || echo "BERSIH"

# Test otomatis (F3+)
php artisan test
```

**Ambang lulus:** tidak ada 500 di rute mana pun; test otomatis hijau; tidak ada data sales hardcoded tersisa.

---

## 6. Manajemen Lingkungan

| Aspek | Nilai | Catatan |
|---|---|---|
| PHP | `/usr/bin/php` (8.5.4) | `php` di PATH harus 8.5 |
| Extensi | `ext-intl` via `PHP_INI_SCAN_DIR` + `LD_LIBRARY_PATH` | Di-set di `.bashrc`; tanpa sudo |
| Composer | `/home/liinz/.local/php84/composer` (jarak 2.10.3) | Dijalankan dengan `/usr/bin/php` |
| Server dev | `php artisan serve --host=127.0.0.1 --port=8000` | Jalankan sebagai proses background |
| Build aset | `npm run build` | Vite 5 |
| Graf kode | `graphify-out/` | Diperbarui hook post-commit |

**Catatan penting:** bila `php -m | grep intl` kosong di shell baru, periksa `.bashrc` (`PHP_INI_SCAN_DIR`, `LD_LIBRARY_PATH`).

---

## 7. Git

- **Commit hanya dengan izin eksplisit pemilik.** Agen kode dilarang commit sendiri.
- Pesan commit: `<tipe>: <ringkas>` (`feat` / `fix` / `chore` / `docs` / `refactor`).
- Satu commit per fase yang lulus verifikasi.
- `push` hanya setelah izin; remote `origin main`.
- `graphify-out/cache/` diabaikan; keluaran graf (graph.json, GRAPH_REPORT.md) tetap dilacak.
- Sebelum commit: `git status --short` untuk memastikan tidak ada berkas sementara (`.hermes-*.md` tidak ikut).

---

## 8. Dokumentasi

| Berkas | Isi | Kapan diperbarui |
|---|---|---|
| `docs/prd.md` | Kebutuhan, ruang lingkup, kriteria | Saat kebutuhan berubah |
| `docs/design.md` | Token, komponen, layar, aksesibilitas | Saat desain berubah |
| `docs/arsitektur.md` | Struktur, model data, otorisasi, ADR | Saat keputusan teknis dibuat |
| `docs/todo.md` | Daftar tugas per fase | Setiap fase selesai |
| `docs/workflow.md` | Berkas ini | Saat cara kerja berubah |
| `AGENTS.md` (root) | Pointer ke note Obsidian | Jarang |
| Note Obsidian | Rekap proyek + log | Setiap milestone |

**Aturan:** keputusan baru dicatat di bagian "Log" note Obsidian **sebelum sesi berakhir**, dengan tanggal dan alasan.

---

## 9. Eskalasi ke Pemilik Produk

Hentikan pekerjaan dan tanyakan bila:
- Perlu data nyata (nomor kontak asli, kredensial)
- Perlu izin `sudo` / instalasi sistem
- Perlu keputusan produk (mis. boleh sales hapus dokumentasi sendiri?)
- Tindakan destruktif (menghapus data, menulis ulang riwayat git)
- Dependency baru di luar ekosistem yang disetujui

---

## 10. Checklist Ringkas Sebelum Menyatakan Fase Selesai

- [ ] Kode dijalan oleh OpenCode (bukan tulisan tangan orkestrator)
- [ ] `git status` ditinjau; tidak ada berkas tak diinginkan
- [ ] Perintah verifikasi dijalankan, keluarannya dilihat sendiri
- [ ] Tidak ada regresi rute lama (semua 200)
- [ ] Tidak ada data hardcoded yang seharusnya dari DB
- [ ] Test otomatis hijau (F3 ke atas)
- [ ] `docs/todo.md` ditandai selesai
- [ ] Note Obsidian diperbarui
- [ ] Laporan ringkas ke pemilik produk + minta izin commit
