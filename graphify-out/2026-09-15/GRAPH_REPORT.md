# Graph Report - hyundaimks  (2026-09-15)

## Corpus Check
- 55 files · ~587,946 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 227 nodes · 209 edges · 46 communities (14 shown, 9 thin omitted)
- Extraction: 99% EXTRACTED · 1% INFERRED · 0% AMBIGUOUS · INFERRED: 2 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `d78f7d42`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- package.json
- Controller
- Scope (urut prioritas)
- 0001_01_01_000000_create_users_table.php
- UserFactory.php
- User
- devDependencies
- scripts.js
- Project Name: **Hyundai Dealer Makassar**
- config
- scripts
- TestCase
- AppServiceProvider
- logging.php
- bootstrap/app.php
- ExampleTest
- hyundaimks
- app.blade.php
- home.blade.php
- console.php
- graphify.js
- Illuminate\Http\Request

## God Nodes (most connected - your core abstractions)
1. `Controller` - 19 edges
2. `require-dev` - 8 edges
3. `Project Name: **Hyundai Dealer Makassar**` - 8 edges
4. `User` - 7 edges
5. `Scope (urut prioritas)` - 7 edges
6. `scripts` - 6 edges
7. `UI/UX Redesign — Hyundai Dealer Makassar` - 6 edges
8. `config` - 5 edges
9. `AppServiceProvider` - 4 edges
10. `require` - 4 edges

## Surprising Connections (you probably didn't know these)
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ExampleTest.php → tests/TestCase.php

## Import Cycles
- None detected.

## Communities (46 total, 9 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.06
Nodes (30): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+22 more)

### Community 1 - "package.json"
Cohesion: 0.09
Nodes (20): dependencies, bootstrap, jquery, swiper, private, scripts, build, dev (+12 more)

### Community 3 - "Scope (urut prioritas)"
Cohesion: 0.15
Nodes (12): 1. Bug fix (wajib, blocking), 2. Layout base (single source of truth), 3. Konsolidasi CSS, 4. Responsif konsisten, 5. De-duplikasi halaman produk (PENTING), 6. Data mobil di homepage, Cara verifikasi (agent wajib jalankan), Constraints (+4 more)

### Community 4 - "0001_01_01_000000_create_users_table.php"
Cohesion: 0.23
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 5 - "UserFactory.php"
Cohesion: 0.22
Nodes (5): UserFactory, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Support\Facades\Hash, Illuminate\Support\Str, static

### Community 6 - "User"
Cohesion: 0.29
Nodes (6): User, DatabaseSeeder, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Seeder, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable

### Community 7 - "devDependencies"
Cohesion: 0.22
Nodes (9): devDependencies, autoprefixer, axios, concurrently, laravel-mix, laravel-vite-plugin, postcss, tailwindcss (+1 more)

### Community 8 - "scripts.js"
Cohesion: 0.22
Nodes (5): galleryImages, header, imageContainer, imageData, promoImages

### Community 9 - "Project Name: **Hyundai Dealer Makassar**"
Cohesion: 0.22
Nodes (8): Additional UI Settings, Contribution, Description, Installation and Setup, Key Features, Project Name: **Hyundai Dealer Makassar**, Project Structure, Technologies Used

### Community 10 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 11 - "scripts"
Cohesion: 0.33
Nodes (6): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd

### Community 12 - "TestCase"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase

### Community 14 - "logging.php"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 15 - "bootstrap/app.php"
Cohesion: 0.50
Nodes (3): Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

## Knowledge Gaps
- **81 isolated node(s):** `name`, `type`, `description`, `keywords`, `license` (+76 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 150 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **9 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `config` connect `config` to `composer.json`?**
  _High betweenness centrality (0.009) - this node is a cross-community bridge._
- **Why does `devDependencies` connect `devDependencies` to `package.json`?**
  _High betweenness centrality (0.009) - this node is a cross-community bridge._
- **What connects `name`, `type`, `description` to the rest of the system?**
  _81 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.06451612903225806 - nodes in this community are weakly interconnected._
- **Should `package.json` be split into smaller, more focused modules?**
  _Cohesion score 0.09057971014492754 - nodes in this community are weakly interconnected._
- **Should `Controller` be split into smaller, more focused modules?**
  _Cohesion score 0.14285714285714285 - nodes in this community are weakly interconnected._