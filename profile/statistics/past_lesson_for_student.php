<div id="smallRight"><h3>Прошедшие занятия</h3>
    <table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
        <?
        $journal = new journal($my->group);
        $lessons = $journal->getPreviousLessons();
        if (is_null($lessons)) {
            for ($i = 0; $i < 7; $i++) {
                print "
            <tr>
                <td style='border: none;padding: 4px;'>-</td>
            </tr>
            ";
            }
        } else {
            foreach ($lessons as $key => $les) {
                if (is_null($lessons[$key])) {
                    print "
                            <tr>
                                <td style='border: none;padding: 4px;'>-</td>
                            </tr>";
                    continue;
                }
                $discipline = $les->getDiscipline();
                $group = $les->getGroup();
                $evaluation = $les->getEvaluationUser($my->id);
                print "
        <tr>
            <td style='border: none;padding: 4px;'>$discipline->name</td>
            <td style='border: none;padding: 4px;'><b>$les->date</b></td>
            <td style='border: none;padding: 4px;'><b>$les->time</b></td>
            <td style='border: none;padding: 4px;'><b>$evaluation</b></td>
        </tr>
            ";
            }
        }
        ?>
    </table>
</div>