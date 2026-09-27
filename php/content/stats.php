<?php
/* Historical activity dashboard.
 * Uses the existing programs/archive/organizers schema; no schema changes required.
 */
$statsYears = array();
$statsTypes = array();
$statsArchiveLabels = array();
$statsOrganizers = array();
$statsProgramsTotal = 0;
$statsArchiveTotal = 0;
$statsProgramDays = array();

function statsAddCount(&$array, $key, $value = 1) {
    if (!isset($array[$key])) $array[$key] = 0;
    $array[$key] += $value;
}

/* Programs: intentionally query all records, not the public/current-program
 * $prog array, because this page is an historical view. */
$statsProgramQuery = "SELECT ProgramID, ProgramNameHun, ProgramNameEng, StartDate, EndDate, Days,
    FormHun, FormEng, Ready
    FROM programs
    WHERE StartDate IS NOT NULL
    ORDER BY StartDate ASC";
$statsResult = mysqli_query($dbc, $statsProgramQuery);

if ($statsResult) {
    while ($row = mysqli_fetch_assoc($statsResult)) {
        $statsProgramsTotal++;
        $year = substr($row['StartDate'], 0, 4);
        statsAddCount($statsYears, $year);
        $type = trim($row['FormHun'] ?: $row['FormEng']);
        if ($type === '') $type = 'Program';
        statsAddCount($statsTypes, $type);

        $days = (int)$row['Days'];
        if ($days > 0) {
            $statsProgramDays[] = $days;
        }
    }
}

/* Archive: event history complements the structured programs table. */
$statsArchiveQuery = "SELECT StartDate, EndDate, Labels, Display
    FROM archive
    WHERE Display <> 'no'
      AND StartDate IS NOT NULL
    ORDER BY StartDate ASC";
$statsResult = mysqli_query($dbc, $statsArchiveQuery);

if ($statsResult) {
    while ($row = mysqli_fetch_assoc($statsResult)) {
        $statsArchiveTotal++;
        $year = substr($row['StartDate'], 0, 4);
        statsAddCount($statsYears, $year);

        $labels = preg_split('/[,;]+/', strtolower((string)$row['Labels']));
        foreach ($labels as $label) {
            $label = trim($label);
            if ($label !== '') statsAddCount($statsArchiveLabels, $label);
        }
    }
}

/* People/program relationships. We count program appearances, not unique
 * people, because the current schema does not expose attendance data. */
$statsOrganizerQuery = "SELECT
        CASE WHEN o.OrganizerNameHun <> '' THEN o.OrganizerNameHun ELSE o.OrganizerNameEng END AS OrganizerName,
        COUNT(DISTINCT j.ProgramID) AS ProgramCount
    FROM organizers o
    INNER JOIN progorgsjunction j ON o.OrganizerID = j.OrganizerID
    GROUP BY o.OrganizerID, OrganizerName
    ORDER BY ProgramCount DESC, OrganizerName ASC
    LIMIT 12";
$statsResult = mysqli_query($dbc, $statsOrganizerQuery);

if ($statsResult) {
    while ($row = mysqli_fetch_assoc($statsResult)) {
        $statsOrganizers[] = array(
            'name' => $row['OrganizerName'],
            'count' => (int)$row['ProgramCount']
        );
    }
}

ksort($statsYears, SORT_NUMERIC);
arsort($statsTypes);
arsort($statsArchiveLabels);

$statsYearLabels = array_keys($statsYears);
$statsYearValues = array_values($statsYears);
$statsPeakYear = '';
$statsPeakValue = 0;
foreach ($statsYears as $year => $count) {
    if ($count > $statsPeakValue) {
        $statsPeakYear = $year;
        $statsPeakValue = $count;
    }
}

$statsAvgDays = count($statsProgramDays) ? round(array_sum($statsProgramDays) / count($statsProgramDays), 1) : 0;
$statsFirstYear = count($statsYearLabels) ? $statsYearLabels[0] : '';
$statsLastYear = count($statsYearLabels) ? $statsYearLabels[count($statsYearLabels) - 1] : '';

$isHun = ($_SESSION['lang'] !== 'eng');
$statsText = $isHun ? array(
    'title' => 'Az Alkotótábor története számokban',
    'intro' => 'Programok, rezidenciák és események az adatbázis jelenlegi állapota alapján.',
    'programs' => 'program az adatbázisban',
    'events' => 'archív esemény',
    'years' => 'év aktivitás',
    'avgdays' => 'átlagos programhossz',
    'timeline' => 'Idővonal',
    'yearly' => 'Aktivitás évenként',
    'types' => 'Programformák',
    'labels' => 'Archív eseménytípusok',
    'organizers' => 'Legtöbbször visszatérő alkotók',
    'programsNote' => 'A programok a strukturált programs táblából, az események az archive táblából származnak. A két adatforrás átfedhet.',
    'organizerNote' => 'Ez a programokhoz kapcsolt alkotói megjelenések száma, nem résztvevői létszám.',
    'from' => 'első év',
    'to' => 'utolsó év',
) : array(
    'title' => 'The Creative Camp in numbers',
    'intro' => 'Programs, residencies and events based on the current database.',
    'programs' => 'programs in database',
    'events' => 'archived events',
    'years' => 'active years',
    'avgdays' => 'average program length',
    'timeline' => 'Timeline',
    'yearly' => 'Activity by year',
    'types' => 'Program forms',
    'labels' => 'Archived event types',
    'organizers' => 'Most recurring contributors',
    'programsNote' => 'Programs come from the structured programs table; events come from archive. The two sources may overlap.',
    'organizerNote' => 'This counts contributor appearances linked to programs, not attendance.',
    'from' => 'first year',
    'to' => 'last year',
);
?>
<div class="at-content at-padding-32 at-stats">
    <header class="at-stats-header">
        <p class="at-stats-kicker">KŐVÁGÓÖRS ALKOTÓTÁBOR</p>
        <h1><?php echo $statsText['title']; ?></h1>
        <p><?php echo $statsText['intro']; ?></p>
    </header>

    <section class="at-stats-kpis" aria-label="Statistics">
        <div class="at-stats-kpi"><strong><?php echo number_format($statsProgramsTotal, 0, ',', ' '); ?></strong><span><?php echo $statsText['programs']; ?></span></div>
        <div class="at-stats-kpi"><strong><?php echo number_format($statsArchiveTotal, 0, ',', ' '); ?></strong><span><?php echo $statsText['events']; ?></span></div>
        <div class="at-stats-kpi"><strong><?php echo count($statsYearLabels); ?></strong><span><?php echo $statsText['years']; ?></span></div>
        <div class="at-stats-kpi"><strong><?php echo $statsAvgDays; ?></strong><span><?php echo $statsText['avgdays']; ?></span></div>
    </section>

    <section class="at-stats-section">
        <div class="at-stats-section-title">
            <h2><?php echo $statsText['timeline']; ?></h2>
            <span><?php echo htmlspecialchars($statsFirstYear . ' — ' . $statsLastYear); ?></span>
        </div>
        <div class="at-stats-timeline">
            <?php foreach ($statsYears as $year => $count): ?>
                <div class="at-stats-timeline-year" style="--activity: <?php echo max(0.18, min(1, $count / max(1, $statsPeakValue))); ?>">
                    <div class="at-stats-timeline-dot"></div>
                    <strong><?php echo htmlspecialchars($year); ?></strong>
                    <span><?php echo $count; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($statsPeakYear): ?>
            <p class="at-stats-note"><?php echo htmlspecialchars($statsPeakYear); ?> · <?php echo $statsPeakValue; ?> <?php echo $isHun ? 'nyilvántartott tétel'; : 'recorded items'; ?></p>
        <?php endif; ?>
    </section>

    <div class="at-stats-grid">
        <section class="at-stats-card">
            <h2><?php echo $statsText['yearly']; ?></h2>
            <div class="at-stats-bars">
                <?php foreach ($statsYears as $year => $count): ?>
                    <div class="at-stats-bar-row">
                        <span><?php echo htmlspecialchars($year); ?></span>
                        <div class="at-stats-bar-track"><i style="width: <?php echo round($count / max(1, $statsPeakValue) * 100); ?>%"></i></div>
                        <b><?php echo $count; ?></b>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="at-stats-card">
            <h2><?php echo $statsText['types']; ?></h2>
            <div class="at-stats-bars">
                <?php foreach ($statsTypes as $type => $count): ?>
                    <div class="at-stats-bar-row">
                        <span title="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></span>
                        <div class="at-stats-bar-track"><i style="width: <?php echo round($count / max(1, max($statsTypes)) * 100); ?>%"></i></div>
                        <b><?php echo $count; ?></b>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="at-stats-card">
            <h2><?php echo $statsText['labels']; ?></h2>
            <div class="at-stats-tags">
                <?php foreach ($statsArchiveLabels as $label => $count): ?>
                    <span><b><?php echo $count; ?></b> <?php echo htmlspecialchars($label); ?></span>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="at-stats-card">
            <h2><?php echo $statsText['organizers']; ?></h2>
            <ol class="at-stats-ranking">
                <?php foreach ($statsOrganizers as $person): ?>
                    <li><span><?php echo htmlspecialchars($person['name']); ?></span><b><?php echo $person['count']; ?></b></li>
                <?php endforeach; ?>
            </ol>
            <p class="at-stats-note"><?php echo $statsText['organizerNote']; ?></p>
        </section>
    </div>

    <p class="at-stats-source"><?php echo $statsText['programsNote']; ?></p>
</div>
