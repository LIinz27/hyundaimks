# hyundaimks

Rekap projek lengkap: /mnt/c/Users/micha/Documents/Obsidian Vault/Hermes/Projects/hyundaimks.md

Baca file itu sebelum mulai kerja. Setelah ada keputusan baru atau perubahan arah,
tambahkan ke bagian "Log" di sana sebelum sesi berakhir.

## ATURAN WAJIB: Obsidian selalu diperbarui

Setiap kali projek ini disentuh, note Obsidian **harus** diperbarui. Ini permintaan
eksplisit pemilik projek, berlaku untuk setiap sesi, tanpa perlu diminta ulang.

Dua berkas yang dijaga:

| Berkas | Isi |
|---|---|
| `…/Hermes/Projects/hyundaimks.md` | note utama — status, keputusan, Log, Pelajaran, Sisa Pekerjaan |
| `…/Hermes/Projects/hyundaimks-docs/` | salinan `docs/` + `docs/tasks/` |

Yang wajib, setiap kali ada perubahan berarti:

1. Tambah entri baru di bagian **Log** (tanggal, apa yang berubah, hasil verifikasi, commit).
2. Perbarui **Status/stage** di frontmatter dan awal note bila fase berubah.
3. Perbarui **Sisa Pekerjaan** — centang yang selesai, tambah yang baru.
4. Tambah ke **Pelajaran** bila ada bug/pelajaran yang layak diingat sesi berikutnya.
5. Salin ulang dokumen: `cp docs/*.md` dan `cp docs/tasks/*.md` ke `hyundaimks-docs/`.

Jangan menunggu diminta. Kerjakan sebagai bagian dari menyelesaikan tugas.

## graphify

This project has a knowledge graph at graphify-out/ with god nodes, community structure, and cross-file relationships.

When the user types `/graphify`, use the installed graphify skill or instructions before doing anything else.

Rules:
- For codebase questions, first run `graphify query "<question>"` when graphify-out/graph.json exists. Use `graphify path "<A>" "<B>"` for relationships and `graphify explain "<concept>"` for focused concepts. These return a scoped subgraph, usually much smaller than GRAPH_REPORT.md or raw grep output.
- Dirty graphify-out/ files are expected after hooks or incremental updates; dirty graph files are not a reason to skip graphify. Only skip graphify if the task is about stale or incorrect graph output, or the user explicitly says not to use it.
- If graphify-out/wiki/index.md exists, use it for broad navigation instead of raw source browsing.
- Read graphify-out/GRAPH_REPORT.md only for broad architecture review or when query/path/explain do not surface enough context.
- After modifying code, run `graphify update .` to keep the graph current (AST-only, no API cost).
